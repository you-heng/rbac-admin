<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class Admin extends Base
{
    // 设置表名
    protected $name = 'admin';
    // 设置json类型字段
    protected $json = ['role_ids', 'team_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'team_ids');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchUsernameAttr($query, $value, $data)
    {
        $query->where('username', 'like', '%' . $value .'%');
    }

    public function searchPhoneAttr($query, $value, $data)
    {
        $query->where('phone', 'like', '%' . $value .'%');
    }
}
