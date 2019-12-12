<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_jurisdiction}}`.
 */
class m191212_033300_create_role_Jurisdiction_table extends Migration
{
    public $tableName = '{{%role_jurisdiction}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="权限表"';
        }
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('权限对应的角色id'),
            'controller' => $this->string()->notNull()->defaultValue('')->comment('控制器名'),
            'action' => $this->string()->notNull()->defaultValue('')->comment('方法名'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role_jurisdiction}}');
    }
}
