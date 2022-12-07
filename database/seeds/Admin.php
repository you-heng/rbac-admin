<?php

use think\migration\Seeder;
use think\facade\Config;

class Admin extends Seeder
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
            'username' => 'admin',
            'password' => md5(sha1(md5(123456, Config::get('admin.password_salt')))),
            'avatar' => json_encode([
                "name" => "Ft0mabo_PxdNGeUCi81qGPXcMnWe",
                "url" => "http://sys.anmixiu.com/ad7bc863acc50ad3b747c51c2f85b431.jpg"
            ]),
            'phone' => '15000000000',
            'email' => '123456@qq.com',
            'role_ids' => json_encode(['超级管理员']),
            'team_ids' => json_encode([1,3]),
            'job_id' => 2,
        ];

        $seed = $this->table('admin');
        $seed->insert($data)->save();
    }
}