<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RbacDictTable extends Migrator
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
        $table = $this->table('dict', ['engine' => 'MyISAM', 'collation' => 'utf8_unicode_ci', 'comment' => '' ,'id' => 'id' ,'primary_key' => ['id']]);
        $table->addColumn('key', 'string', ['limit' => 20,'null' => false,'default' => null,'signed' => true,'comment' => '配置名'])
            ->addColumn('val', 'string', ['limit' => 255,'null' => false,'default' => null,'signed' => true,'comment' => '配置值'])
            ->addColumn('remark', 'string', ['limit' => 80,'null' => false,'default' => null,'signed' => true,'comment' => '备注'])
            ->addColumn('is_type', 'boolean', ['null' => false,'default' => null,'signed' => true,'comment' => '类型 1-text 2-json 3-image'])
            ->addColumn('sort', 'integer', ['null' => false,'default' => 1,'signed' => true,'comment' => '排序'])
            ->addColumn('is_state', 'boolean', ['null' => false,'default' => 1,'signed' => true,'comment' => '状态 1-启用 2-禁用'])
            ->addColumn('create_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '创建时间'])
            ->addColumn('update_time', 'timestamp', ['null' => false,'default' => 'CURRENT_TIMESTAMP','signed' => true,'comment' => '修改时间'])
            ->create();
    }
}
