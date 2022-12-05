<?php

use think\migration\Seeder;

class Team extends Seeder
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
                'team_name' => 'xxx公司',
                'p_ids' => json_encode([0])
            ],
            1 => [
                'team_name' => '管理部',
                'p_ids' => json_encode([1])
            ],
            2 => [
                'team_name' => '研发部',
                'p_ids' => json_encode([1])
            ],
            3 => [
                'team_name' => '客服部',
                'p_ids' => json_encode([1])
            ]
        ];
        $seed = $this->table('team');
        $seed->insert($data)->save();
    }
}