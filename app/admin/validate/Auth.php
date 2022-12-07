<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Auth extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'title|权限名' => 'require',
        'icon|字体图标' => 'require',
        'path|地址' => 'require',
        'p_ids|父级权限' => 'require',
        'is_menu|权限类型' => 'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'title.require' => '请填写权限名',
        'icon.require' => '请填写字体图标',
        'path.require' => '请填写地址',
        'p_ids.require' => '请选择一个父级权限',
        'is_menu.require' => '选择一个权限类型',
    ];

    /**
     * 验证场景
     * @var \string[][]
     */
    protected $scene = [
        'create' => ['title', 'icon', 'path', 'p_ids', 'is_menu'],
        'update' => ['title', 'path', 'p_ids', 'is_menu']
    ];
}
