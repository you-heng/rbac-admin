<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use think\Exception;
use think\facade\Cache;
use app\admin\model\Dict as dictModel;
use app\admin\model\BlackList as BlackListModel;
use think\facade\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Check
{
    /**
     * 处理请求
     * @param $request
     * @param \Closure $next
     * @return mixed|\think\response\Json
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle($request, \Closure $next)
    {
        try {
            $url = Request::baseUrl();
            $url = rtrim($url, '/');

            // 接口白名单
            $config = dictModel::where('key', 'in', ['white_list', 'jwt_key'])->column('key,val');
            $config = array_column($config, 'val', 'key');
            $config['white_list'] = json_decode($config['white_list'],true);
            if(in_array($url, $config['white_list'])){
                return $next($request);
            }

            // ip防火墙
            $ip = Request::ip();
            $ipList = BlackListModel::where('is_state', 1)->field('ip,time,is_type')->select();
            $time = date('Y-m-d H:i:s', time());
            foreach($ipList as $v){
                if($v['is_type'] == 1){
                    if($ip == $v['ip']){
                        return json(['code' => 405, 'msg' => '您已经被系统拉黑，请联系管理员！']);
                    }
                }else if($v['is_type'] == 2){
                    if($time < $v['time'] && $ip == $v['ip']){
                        return json(['code' => 405, 'msg' => '您已经被系统拉黑，请联系管理员！']);
                    }
                }
            }

            // token验证
            $uniquid = Request::header('uniquid');
            $token = Request::header('token');
            if(empty($uniquid) || empty($token)){
                return json(['code' => 403, 'msg' => '请先登录!']);
            }
            $user = Cache::store('memcached')->get($uniquid);
            $user = json_decode($user, true);
            $decode = JWT::decode($token, new Key($config['jwt_key'], 'HS256'));
            $time = time();
            if($decode->exp < $time){
                return json(['code' => 402, 'msg' => 'token过期，重新登录!']);
            }
            if($token != $user['token'] || $user['uniquid'] != $decode->jti){
                return json(['code' => 402, 'msg' => 'token失效，重新登录']);
            }

            // 权限验证
            if($user['role']['auth'] == '*'){
                return $next($request);
            }
            $list = array_merge($user['role']['auth'], $config['white_list']);
            if(in_array($url, $list)){
                return $next($request);
            }
            return json(['code' => 401, 'msg' => '您没有当前权限，如有需求请联系超级管理员']);
        }catch (Exception $e){
            return json(['code' => 402, 'msg' => $e->getMessage()]);
        }
        return $next($request);
    }
}
