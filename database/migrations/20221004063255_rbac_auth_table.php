<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RbacAuthTable extends Migrator
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
        $table = $this->table('auth', ['engine' => 'MyISAM', 'collation' => 'utf8_unicode_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('title', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '权限名',])
            ->addColumn('icon', 'string', ['limit' => 20,'null' => true,'signed' => true,'comment' => '字体图标',])
            ->addColumn('path', 'string', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '地址',])
            ->addColumn('p_ids', 'json', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '父级id组',])
            ->addColumn('is_menu', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '1-菜单 2-权限',])
            ->addColumn('sort', 'integer', ['null' => false,'default' => 1,'signed' => true,'comment' => '排序'])
            ->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间',])
            ->addColumn('update_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '修改时间',])
            ->create();
    }
}
