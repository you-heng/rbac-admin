<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\captcha\facade\Captcha;
use think\facade\Db;
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
        //$table = \think\Db::connect('mongo')->table('test')->select();
        /*$table = Db::connect('mongo')->table('test')->select();
        halt($table);*/



        /*Db::connect('mongo')->table('test')->insert([
            'id' => 1,
            'name' => 'zhangsan'
        ]);*/
        //echo 'index';
        /*$avatar = json_encode([
            "name" => "Ft0mabo_PxdNGeUCi81qGPXcMnWe",
            "url" => "http://sys.anmixiu.com/ad7bc863acc50ad3b747c51c2f85b431.jpg"
        ]);
        dictModel::where('key', 'user_avatar')->update(['val' => $avatar]);*/
        /*$data = authModel::field('id,title,icon,path,p_ids,is_menu,sort')->select()->toArray();
        halt(json_encode($data));*/

//        $uid = rand(10000,99999);
//        $num = 10;
//        $name = 'test';
//        $redis = Cache::store('redis')->handler();
//        $redis->lpush($name, $uid);
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
        $admin = adminModel::where('username', $data['username'])->field('username,password,email,phone,avatar,role_ids,is_state')->find()->toArray();
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
            'jti' => md5($admin['username'] . '-' . uniqid('JWT').time()), // 唯一标识
        ];
        $jwt = JWT::encode($payload, $config['jwt_key'], 'HS256');
        $admin['avatar'] = json_decode($admin['avatar'], true);
        $username = [
            'username' => $data['username'],
            'password' => $data['password'],
            'token' => $jwt,
            'uniquid' => $payload['jti'],
            'role' => $role,
            'email' => $admin['email'],
            'phone' => $admin['phone'],
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
        $captcha = Captcha::create_isolate();
        return $this->message(200, '成功', $captcha);
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

    /**
     * 更新用户信息
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function userinfo()
    {
        $data = Request::post();
        $data['avatar'] = json_encode($data['avatar']);
        adminModel::where('username', $data['username'])->update($data);
        $admin = adminModel::where('username', $data['username'])->field('username,email,phone,avatar')->find()->toArray();
        $admin['avatar'] = json_decode($admin['avatar'], true);
        $uniquid = Request::header('uniquid');
        $user = Cache::store('redis')->get($uniquid);
        $user = json_decode($user, true);
        $user['email'] = $admin['email'];
        $user['phone'] = $admin['phone'];
        $user['avatar'] = $admin['avatar'];
        Cache::store('redis')->set($uniquid, json_encode($user));
        return $this->message(200, '更新成功', $user);
    }

    /**
     * 修改密码
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function pass()
    {
        $data = Request::post();
        $password = encry($data['password']);
        $admin = adminModel::where('username', $data['username'])->field('username,password')->find();
        if($admin['password'] != $password){
            return $this->message(201, '旧密码不正确');
        }
        if($data['newPassword'] != $data['makePassword']){
            return $this->message(201, '两次密码不一致');
        }
        $new = encry($data['newPassword']);
        adminModel::where('username', $data['username'])->update(['password' => $new]);
        return $this->message(200, '密码修改成功，请重新登录');
    }

    public function echarts()
    {
        //$year = recordModel::whereYear('create_time')->select()->toArray();
//        $year = recordModel::where(function ($query){
//            $query->whereYear('create_time');
//            $query->group('create_time');
//        })->select()->toArray();
        //$day = recordModel::whereMonth('create_time')->count();

        /*$month = recordModel::where(function ($query){
            $query->group('create_time')->whereMonth('create_time');
        })->count();
        halt($month);*/
//        var_dump($day);
        echo 111;
    }
}