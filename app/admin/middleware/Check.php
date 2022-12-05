<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use think\facade\Cache;
use app\admin\model\Dict as dictModel;
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
            $config = dictModel::where('key', 'in', ['white_list', 'jwt_key'])->column('key,val');
            $config = array_column($config, 'val', 'key');
            $config['white_list'] = json_decode($config['white_list'],true);
            foreach($config['white_list'] as $v){
                if($v == $url){
                    return $next($request);
                }
            }
            $token = Request::header('token');
            if(!$token){
                return json(['code' => 403, 'msg' => '请先登录!']);
            }
            $uniquid = Request::header('uniquid');
            $user = Cache::store('redis')->get($uniquid);
            $user = json_decode($user, true);
            $decode = JWT::decode($token, new Key($config['jwt_key'], 'HS256'));
            $time = time();
            if($decode->exp < $time){
                return json(['code' => 402, 'msg' => 'token过期，重新登录!']);
            }
            if($token != $user['token'] || $user['uniquid'] != $decode->jti){
                return json(['code' => 402, 'msg' => 'token失效，重新登录']);
            }
        }catch (\Exception $e){
            echo $e->getMessage();die;
        }
        return $next($request);
    }
}
