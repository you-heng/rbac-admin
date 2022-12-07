<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RbacAdminTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('admin', ['engine' => 'MyISAM', 'collation' => 'utf8_unicode_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '用户名'])
            ->addColumn('password', 'char', ['limit' => 32,'null' => false,'default' => null,'signed' => true,'comment' => '密码'])
            ->addColumn('avatar', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '头像'])
            ->addColumn('phone', 'char', ['limit' => 11,'null' => false,'default' => null,'signed' => true,'comment' => '手机号'])
            ->addColumn('email', 'string', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '邮箱'])
            ->addColumn('role_ids', 'json', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '角色id组'])
            ->addColumn('team_ids', 'json', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '部门id组'])
            ->addColumn('job_id', 'integer', ['limit' => 11,'null' => false,'default' => null,'signed' => true,'comment' => '岗位id'])
            ->addColumn('sort', 'integer', ['null' => false,'default' => 1,'signed' => true,'comment' => '排序'])
            ->addColumn('is_state', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '状态 1-启用 2-禁用'])
            ->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间'])
            ->create();
    }
}
