<?php

use think\migration\Seeder;

class Role extends Seeder
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
                'role_name' => '超级管理员',
                'intro' => '拥有至高无上的权限',
                'menu_ids' => json_encode(['*']),
                'auth_ids' => json_encode(['*'])
            ]
        ];

        $seed = $this->table('role');
        $seed->insert($data)->save();
    }
}