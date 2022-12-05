<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class Dict extends Base
{
    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchKeyAttr($query, $value, $data)
    {
        $query->where('key', 'like', '%' . $value . '%');
    }

    public function searchValAttr($query, $value, $data)
    {
        $query->where('val', 'like', '%' . $value . '%');
    }

    public function searchRemarkAttr($query, $value, $data)
    {
        $query->where('remark', 'like', '%' . $value . '%');
    }
}
