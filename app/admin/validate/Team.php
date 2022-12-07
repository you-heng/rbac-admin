<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Team extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'team_name|部门名称' => 'require',
        'p_ids|父级部门' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'team_name.require' => '请填写部门名称',
        'p_ids.require' => '请填写父级部门',
    ];

    /**
     * 验证场景
     * @var array[]
     */
    protected $scene = [
        'create' => ['team_name', 'p_ids']
    ];
}
