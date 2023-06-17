<?php
declare (strict_types = 1);

namespace app\api\controller\v1;

use think\Db;

class Index
{
    public function index()
    {
        return '您好！这是一个[api]示例应用';
    }

    public function test()
    {

    }
}
