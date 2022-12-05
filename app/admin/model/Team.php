<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * @mixin \think\Model
 */
class Team extends Base
{
    // 设置json类型字段
    protected $json = ['p_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;
}
