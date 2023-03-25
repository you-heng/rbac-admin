<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class BlackList extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'ip|ip' => 'require',
        'is_type|类型' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'ip.require' => '请填写ip地址',
        'is_type.require' => '请选择类型',
    ];

    /**
     * @var \string[][]
     * 验证场景
     */
    protected $scene = [
        'create' => ['ip', 'is_type'],
        'update' => ['ip', 'is_type'],
    ];
}
