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
        $this->page = (int)Request::get('page', Config::get('app.page'));
        $this->limit = (int)Request::get('limit', Config::get('app.limit'));
    }

    protected function message(int $code, string $msg, $data = [], string $type = 'json') : Response
    {
        // api结构
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];

        return Response::create($result, $type);
    }
}
