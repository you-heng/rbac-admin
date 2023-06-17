<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

class RebateBase
{
    public function __construct()
    {
        $this->check_ip();
    }

    public function check_ip()
    {

    }
}
