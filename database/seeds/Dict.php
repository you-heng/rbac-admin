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
                'remark' => '用户默认密码'
            ],
            1 => [
                'key' => 'user_avatar',
                'val' => 'http://81.71.88.243/avatar.jpg',
                'remark' => '用户默认头像'
            ],
            2 => [
                'key' => 'sys_upload_url',
                'val' => 'http://sys.anmixiu.com/',
                'remark' => '图片上传链接'
            ],
            3 => [
                'key' => 'user_phone',
                'val' => '15000000000',
                'remark' => '默认手机号码'
            ],
            4 => [
                'key' => 'user_email',
                'val' => '123456@qq.com',
                'remark' => '默认邮箱'
            ],
            5 => [
                'key' => 'jwt_sub',
                'val' => 'http://rbac.com/',
                'remark' => 'jwt所面向用户'
            ],
            6 => [
                'key' => 'jwt_time',
                'val' => 86400,
                'remark' => '过期时间->86400一天'
            ],
            7 => [
                'key' => 'jwt_key',
                'val' => 'rbac.com',
                'remark' => 'jwt的key'
            ],
            8 => [
                'key' => 'pic_url',
                'val' => 'http://sys.anmixiu.com/',
                'remark' => '上传图片的域名'
            ],
            9 => [
                'key' => 'qiniu_access_key',
                'val' => 'uvBhV1VdIykjB5snuJQZs3JVARZQCEYUdkzj5dwu',
                'remark' => '七牛云配置：accesskey'
            ],
            10 => [
                'key' => 'qiniu_secret_key',
                'val' => 'QpwBv4uva8Ztqf-LNRsG_TEesbkpZ6uHEx_uvfpR',
                'remark' => '七牛云配置：secretkey'
            ],
            11 => [
                'key' => 'qiniu_bucket',
                'val' => 'system-upload',
                'remark' => '七牛云配置：bucket'
            ],
            12 => [
                'key' => 'white_list',
                'val' => json_encode([
                    0 => '/console/index/captcha',
                    1 => '/console/index/login',
                    2 => '/console/index/logout',
                    3 => '/console/index/config',
                    4 => '/console/auth/menu'
                ]),
                'remark' => '接口白名单'
            ],
            13 => [
                'key' => 'sys_title',
                'val' => '权限管理系统',
                'remark' => '系统名称'
            ],
            14 => [
                'key' => 'sys_log',
                'val' => '/vite.svg',
                'remark' => '系统logo'
            ]
        ];

        $seed = $this->table('dict');
        $seed->insert($data)->save();
    }
}