<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Role extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'role_name|角色名称' => 'require',
        'intro|角色描述' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'role_name.require' => '请填写角色名称',
        'intro.require' => '请填写角色描述',
    ];

    /**
     * 验证场景
     * @var array[]
     */
    protected $scene = [
        'create' => ['role_name', 'intro'],
        'update' => ['role_name', 'intro'],
    ];
}
