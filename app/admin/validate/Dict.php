<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Dict extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'key|配置名称' => 'require',
        'val|配置值' => 'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'key.require' => '请填写配置名称',
        'val.require' => '请填写配置值'
    ];

    /**
     * 验证场景
     * @var array[]
     */
    protected $scene = [
        'create' => ['key', 'val']
    ];
}
