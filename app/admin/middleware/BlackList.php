<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use think\facade\Db;
use think\facade\Request;

class BlackList
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $ip = Request::ip();
        $ipList = Db::name('black_list')->where('is_state', 1)->field('ip,time,is_type')->select();
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
        return $next($request);
    }
}
