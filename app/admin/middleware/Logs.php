<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use think\facade\Cache;
use think\facade\Db;
use think\facade\Request;

class Logs
{
    /**
     * 处理请求
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle($request, \Closure $next)
    {
        try {
            $uniquid = Request::header('uniquid');
            if(!empty($uniquid)){
                $user = Cache::store('redis')->get($uniquid);
                $user = json_decode($user, true);
                $url = Request::baseUrl();
                $ip = Request::ip();
                $data = [
                    'username' => $user['username'],
                    'path' => $url,
                    'ip' => $ip
                ];
                Db::name('login_log')->insert($data);
            }
            return $next($request);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}
