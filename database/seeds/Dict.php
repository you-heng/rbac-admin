<?php

use think\migration\Seeder;

class Dict extends Seeder
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
                'key' => 'user_pass',
                'val' => 123456,
                'remark' => '用户默认密码',
                'is_type' => 1
            ],
            1 => [
                'key' => 'user_avatar',
                'val' => json_encode([
                    "name" => "Ft0mabo_PxdNGeUCi81qGPXcMnWe",
                    "url" => "http://sys.anmixiu.com/ad7bc863acc50ad3b747c51c2f85b431.jpg"
                ]),
                'remark' => '用户默认头像',
                'is_type' => 3
            ],
            2 => [
                'key' => 'sys_upload_url',
                'val' => 'http://sys.anmixiu.com/',
                'remark' => '图片上传链接',
                'is_type' => 1
            ],
            3 => [
                'key' => 'user_phone',
                'val' => '15000000000',
                'remark' => '默认手机号码',
                'is_type' => 1
            ],
            4 => [
                'key' => 'user_email',
                'val' => '123456@qq.com',
                'remark' => '默认邮箱',
                'is_type' => 1
            ],
            5 => [
                'key' => 'jwt_sub',
                'val' => 'http://rbac.com/',
                'remark' => 'jwt所面向用户',
                'is_type' => 1
            ],
            6 => [
                'key' => 'jwt_time',
                'val' => 86400,
                'remark' => '过期时间->86400一天',
                'is_type' => 1
            ],
            7 => [
                'key' => 'jwt_key',
                'val' => 'rbac.com',
                'remark' => 'jwt的key',
                'is_type' => 1
            ],
            8 => [
                'key' => 'pic_url',
                'val' => 'http://sys.anmixiu.com/',
                'remark' => '上传图片的域名',
                'is_type' => 1
            ],
            9 => [
                'key' => 'qiniu_access_key',
                'val' => 'uvBhV1VdIykjB5snuJQZs3JVARZQCEYUdkzj5dwu',
                'remark' => '七牛云配置：accesskey',
                'is_type' => 1
            ],
            10 => [
                'key' => 'qiniu_secret_key',
                'val' => 'QpwBv4uva8Ztqf-LNRsG_TEesbkpZ6uHEx_uvfpR',
                'remark' => '七牛云配置：secretkey',
                'is_type' => 1
            ],
            11 => [
                'key' => 'qiniu_bucket',
                'val' => 'system-upload',
                'remark' => '七牛云配置：bucket',
                'is_type' => 1
            ],
            12 => [
                'key' => 'white_list',
                'val' => json_encode([
                    0 => '/console/index/captcha',
                    1 => '/console/index/login',
                    2 => '/console/index/logout',
                    3 => '/console/index/config',
                    4 => '/console/index/pass',
                    5 => '/console/index/userinfo',
                    6 => '/console/auth/menu',
                    7 => '/console/index/index'
                ]),
                'remark' => '接口白名单',
                'is_type' => 2
            ],
            13 => [
                'key' => 'sys_title',
                'val' => '权限管理系统',
                'remark' => '系统名称',
                'is_type' => 1
            ],
            14 => [
                'key' => 'sys_log',
                'val' => '/vite.svg',
                'remark' => '系统logo',
                'is_type' => 1
            ]
        ];

        $seed = $this->table('dict');
        $seed->insert($data)->save();
    }
}