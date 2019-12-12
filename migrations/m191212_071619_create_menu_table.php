<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu_list}}`.
 */
class m191212_071619_create_menu_table extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%menu_list}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="菜单表"';
        }
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'level' => $this->string(255)->notNull()->defaultValue('0')->comment('菜单等级'),
            'name' => $this->string(255)->notNull()->defaultValue('')->comment('菜单名字'),
            'controller' => $this->string(255)->notNull()->defaultValue('')->comment('控制器名'),
            'action' => $this->string(255)->notNull()->defaultValue('')->comment('方法名'),
            'parent_id' => $this->integer()->notNull()->defaultValue(0)->comment('菜单的父级 0就是顶级菜单'),
            'is_delete' => $this->string(30)->notNull()->defaultValue('no')->comment('是否删除'),
            'is_use'    => $this->string(30)->notNull()->defaultValue('yes')->comment('是否启用'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
