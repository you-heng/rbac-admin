<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class BlackList extends Base
{
    // 设置表名
    protected $name = 'black_list';

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchIpAttr($query, $value, $data)
    {
        $query->where('ip', 'like', '%' . $value .'%');
    }
}
