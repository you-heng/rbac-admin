<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username|用户名' => 'require|unique:admin|length:4,12|alpha',
        'role_ids|角色' => 'require',
        'team_ids|部门' => 'require',
        'job_id|职位' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '请填写用户名',
        'username.unique' => '用户名已经存在',
        'username.length' => '用户名长度在4-12个字符之间',
        'username.alpha' => '用户名只能使用英文字母',
        'role_ids.require' => '请选择至少一个角色',
        'team_ids.require' => '请选择用户所属部门',
        'job_id.require' => '请选择一个职位',
    ];

    /**
     * 验证场景
     * @var \string[][]
     */
    protected $scene = [
        'create' => ['username', 'role_ids', 'team_ids', 'job_id'],
    ];
}
