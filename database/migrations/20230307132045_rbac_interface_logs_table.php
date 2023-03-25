<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RbacInterfaceLogsTable extends Migrator
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
        $table = $this->table('interface_logs', ['engine' => 'MyISAM', 'collation' => 'utf8_unicode_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '操作用户'])
            ->addColumn('tag', 'boolean', ['limit' => 1,'null' => false,'default' => null,'signed' => true,'comment' => '标签 1-读取 2-添加 3-编辑 4-删除 5-搜索 6-导出 7-状态 8-登陆 9-退出'])
            ->addColumn('path', 'string', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '请求地址'])
            ->addColumn('content', 'string', ['limit' => 150,'null' => false,'default' => null,'signed' => true,'comment' => '操作内容'])
            ->addColumn('is_state', 'boolean', ['limit' => 1,'null' => false,'default' => null,'signed' => true,'comment' => '状态 1-成功 2-失败'])
            ->addColumn('ip', 'char', ['limit' => 15,'null' => false,'default' => null,'signed' => true,'comment' => 'ip'])
            ->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间'])
            ->create();
    }
}
