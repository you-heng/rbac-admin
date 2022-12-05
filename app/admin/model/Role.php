<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class Role extends Base
{
    // 设置json类型字段
    protected $json = ['menu_ids', 'auth_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function searchRoleNameAttr($query, $value, $data)
    {
        $query->where('role_name', 'like', '%' . $value .'%');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }
}
