<?php

use think\migration\Seeder;

class Job extends Seeder
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
                'job_name' => '前端'
            ],
            1 => [
                'job_name' => '后端'
            ],
            2 => [
                'job_name' => '测试'
            ]
        ];
        $seed = $this->table('job');
        $seed->insert($data)->save();
    }
}