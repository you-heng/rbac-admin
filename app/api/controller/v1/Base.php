<?php
declare (strict_types = 1);

namespace app\api\controller\v1;

use think\Response;

class Base
{
    public function __construct()
    {
        $this->check_ip();
    }

    public function check_ip()
    {

    }

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
}
