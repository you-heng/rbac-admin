<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\captcha\facade\Captcha;
use think\facade\Request;
use app\admin\model\Admin as adminModel;
use app\admin\model\Role as roleModel;
use app\admin\model\Auth as authModel;
use app\admin\model\Dict as dictModel;
use Firebase\JWT\JWT;
use think\facade\Cache;

class Index extends Base
{
    /**
     * 首页
     * @return string
     */
    public function index()
    {
        echo 'index';
    }

    /**
     * 登录
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login()
    {
        $data = Request::post();
        $captcha = Captcha::check_isolate($data['code'], $data['key']);
        if(!$captcha){
            return $this->message(201, '验证码错误');
        }
        $admin = adminModel::where('username', $data['username'])->field('username,password,avatar,role_ids,is_state')->find()->toArray();
        if($admin['username'] != $data['username'] || $admin['password'] != encry($data['password'])){
            return $this->message(201, '账号密码错误');
        }
        if($admin['is_state'] == 2){
            return $this->message(201, '当前用户被禁用');
        }
        $role = [];
        if($admin['role_ids'][0] != '超级管理员'){
            $role = $this->role($admin['role_ids']);
        }else{
            $menu = authModel::where('is_menu',1)->order('sort', 'desc')->select()->toArray();
            $menu = menu_tree($menu);
            $role['menu'] = tree_data($menu);
            $role['auth'] = '*';
        }
        $config = dictModel::where('key', 'in', ['jwt_key', 'jwt_time', 'jwt_sub'])->column('key,val');
        $config = array_column($config, 'val', 'key');
        $payload = [
            'iss' => $data['username'], // 该jwt的签发者
            'iat' => time(),            // 签发时间
            'exp' => time() + $config['jwt_time'], // 过期时间
            'nbf' => time(),                // 该时间前不接受处理该token
            'sub' => $config['jwt_sub'], // 面向用户
            'jti' => md5(uniqid('JWT').time()), // 唯一标识
        ];
        $jwt = JWT::encode($payload, $config['jwt_key'], 'HS256');
        $username = [
            'username' => $data['username'],
            'password' => $data['password'],
            'token' => $jwt,
            'uniquid' => $payload['jti'],
            'role' => $role,
            'avatar' => $admin['avatar']
        ];
        Cache::store('redis')->set($username['uniquid'], json_encode($username));
        return $this->message(200, '登录成功', $username);
    }


    /**
     * 查询角色权限菜单
     * @param $role_ids
     * @return array|\think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function role($role_ids)
    {
        $role = [];
        $auth_list = [];
        foreach($role_ids as $v){
            $temp = roleModel::where('role_name', $v)->field('is_state,menu_ids,auth_ids')->find()->toArray();
            $role[] = $temp;
            $auth_list[] = array_merge($temp['menu_ids'], $temp['auth_ids']);
        }
        if(!empty($role)){
            foreach($role as $v){
                if($v['is_state'] == 2){
                    return $this->message(201, '当前角色被禁用');
                }
            }
        }
        $list = array_reduce($auth_list, 'array_merge', []);
        $list = array_unique($list);
        $auth = authModel::where('id', 'in', $list)->where('is_menu', 2)->field('path')->select()->toArray();
        $auth = array_column($auth, 'path');
        $menu = authModel::where('id', 'in', $list)->where('is_menu', 1)->order('sort', 'desc')->select()->toArray();
        $menu = menu_tree($menu);
        $menu = tree_data($menu);
        return ['auth' => $auth, 'menu' => $menu];
    }

    /**
     * 退出登录
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function logout()
    {
        $uniquid = Request::header('uniquid');
        Cache::store('redis')->delete($uniquid);
        return $this->message(200, '退出登录');
    }

    /**
     * 验证码
     * @return \think\Response
     */
    public function captcha()
    {
        return Captcha::create_isolate();
    }

    /**
     * 系统设置
     * @return \think\Response
     */
    public function config()
    {
        $config = dictModel::where('key', 'in', ['sys_title', 'sys_log'])->column('key,val');
        if(!empty($config)){
            $config = array_column($config, 'val', 'key');
            return $this->message(201, '成功', $config);
        }
        return $this->message(201, '暂无内容~');
    }
}
