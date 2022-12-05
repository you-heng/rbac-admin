<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RbacLoginLogTable extends Migrator
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
        $table = $this->table('login_log', ['engine' => 'MyISAM', 'collation' => 'utf8_unicode_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('username', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '用户名'])
            ->addColumn('path', 'string', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => 'uri'])
            ->addColumn('ip', 'char', ['limit' => 15,'null' => false,'default' => null,'signed' => true,'comment' => 'ip'])
            ->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间'])
            ->create();
    }
}
