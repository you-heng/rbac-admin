<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Cache;
use think\facade\Config;
use think\facade\Request;
use think\Response;
use think\facade\Db;

abstract class Base
{
    protected $page;
    protected $limit;

    public function __construct()
    {
        $this->page     = (int)Request::get('page', Config::get('app.page'));
        $this->limit    = (int)Request::get('limit', Config::get('app.limit'));
    }

    /**
     * @param int $code
     * @param string $msg
     * @param $data
     * @param string $type
     * @return Response
     * api接口结构
     */
    protected function message(string $msg, int $code = 200, $data = [], string $type = 'json') : Response
    {
        // api结构
        $result = [
            'code'  => $code,
            'msg'   => $msg,
            'data'  => $data
        ];

        return Response::create($result, $type);
    }

    /**
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 获取用户信息
     */
    public function get_user()
    {
        $uniquid = Request::header('uniquid');
        $user = Cache::store('memcached')->get($uniquid);
        $user = json_decode($user, true);
        return $user;
    }


    /**
     * @param $tag
     * @param $content
     * @return void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 写日志
     */
    public function write_logs($tag, $content)
    {
        $user = $this->get_user();
        $data = [
            'username' => $user['username'],
            'tag' => $tag,
            'path' => Request::pathinfo(),
            'content' =>  $user['username'] . $content,
            'ip' => Request::ip()
        ];
        Db::connect('mongo')->name('interface_logs')->insert($data);
    }

    /**
     * @return void
     * 错误日志
     */
    public function write_error()
    {

    }
}
