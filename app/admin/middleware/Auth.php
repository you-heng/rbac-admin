<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use think\facade\Cache;
use think\facade\Request;
use app\admin\model\Dict as dictModel;

class Auth
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
            $uniquid = Request::header('uniquid');
            $config = dictModel::where('key', 'in', ['white_list'])->column('key,val');
            $config = array_column($config, 'val', 'key');
            $config['white_list'] = json_decode($config['white_list'],true);
            if(!empty($uniquid)){
                $user = Cache::store('redis')->get($uniquid);
                $user = json_decode($user, true);
                if($user['role']['auth'] == '*'){
                    return $next($request);
                }
                $list = array_merge($user['role']['auth'], $config['white_list']);
                foreach($list as $v){
                    if($v == $url){
                        return $next($request);
                    }
                }
            }else{
                foreach($config['white_list'] as $v){
                    if($v == $url){
                        return $next($request);
                    }
                }
            }
            return json(['code' => 401, 'msg' => '您没有此项权限，请联系管理员!']);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}
