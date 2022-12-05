<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class Job extends Base
{
    public function searchJobNameAttr($query, $value, $data)
    {
        $query->where('job_name', 'like', '%' . $value .'%');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }
}
