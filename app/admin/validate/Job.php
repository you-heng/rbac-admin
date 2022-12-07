<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Job extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'job_name|职位名称' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'job_name.require' => '请填写职位名称',
    ];

    /**
     * 验证场景
     * @var array[]
     */
    protected $scene = [
        'create' => ['job_name']
    ];
}
