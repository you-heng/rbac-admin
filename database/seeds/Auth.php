<?php

use think\migration\Seeder;

class Auth extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            0 => [
                'id' => 1,
                'title' => '系统管理',
                'icon' => 'icon-xitong',
                'path' => '/system',
                'p_ids' => json_encode([0]),
                'is_menu' => 1
            ],
            1 => [
                'id' => 2,
                'title' => '系统设置',
                'icon' => 'icon-shezhi',
                'path' => '/config',
                'p_ids' => json_encode([0]),
                'is_menu' => 1
            ],
            2 => [
                'id' => 3,
                'title' => '用户管理',
                'icon' => 'icon-guanliyuan',
                'path' => '/system/admin',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            3 => [
                'id' => 4,
                'title' => '角色管理',
                'icon' => 'icon-jiaose',
                'path' => '/system/role',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            4 => [
                'id' => 5,
                'title' => '权限管理',
                'icon' => 'icon-quanxianpeizhi',
                'path' => '/system/auth',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            5 => [
                'id' => 6,
                'title' => '部门管理',
                'icon' => 'icon-tuandui',
                'path' => '/system/team',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            6 => [
                'id' => 7,
                'title' => '职位管理',
                'icon' => 'icon-zhiwei',
                'path' => '/system/job',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            7 => [
                'id' => 8,
                'title' => '字典管理',
                'icon' => 'icon-shujuzidian',
                'path' => '/config/dict',
                'p_ids' => json_encode([2]),
                'is_menu' => 1
            ],
            8 => [
                'id' => 9,
                'title' => '日志管理',
                'icon' => 'icon-peizhi',
                'path' => '/config/logs',
                'p_ids' => json_encode([2]),
                'is_menu' => 1
            ],
        ];

        $seed = $this->table('auth');
        $seed->insert($data)->save();
    }
}