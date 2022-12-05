<?php
declare (strict_types = 1);

namespace app\admin\controller;

class Error extends Base
{
    public function index()
    {
        return $this->message(200, '资源不存在～2222');
    }
}
