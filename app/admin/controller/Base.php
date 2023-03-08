<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Config;
use think\facade\Request;
use think\Response;

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
    protected function message(int $code, string $msg, $data = [], string $type = 'json') : Response
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
     * @param int $code
     * @param string $msg
     * @param $data
     * @param string $type
     * @return Response
     * 列表api结构
     */
    public function message_list(int $code, string $msg, int $count, $data = [], string $type = 'json') : Response
    {
        // 列表api结构
        $result = [
            'code'  => $code,
            'msg'   => $msg,
            'page'  => $this->page,
            'limit' => $this->limit,
            'count' => $count,
            'data'  => $data
        ];

        return Response::create($result, $type);
    }


    /**
     * @return void
     * 写日志
     */
    public function write_logs()
    {

    }

    /**
     * @return void
     * 错误日志
     */
    public function write_error()
    {

    }
}
