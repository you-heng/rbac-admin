<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class InterfaceLogs extends Base
{
    protected $name = 'interface_logs';

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchUsernameAttr($query, $value, $data)
    {
        $query->where('username', 'like', '%' . $value . '%');
    }

    public function searchIpAttr($query, $value, $data)
    {
        $query->where('ip', '=', $value);
    }
}
