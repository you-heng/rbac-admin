<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Record extends Model
{
    protected $name = 'login_log';

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
