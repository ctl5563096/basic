<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin_user}}`.
 */
class m191204_074624_create_admin_user_table extends Migration
{
    public $tableName = '{{%admin_user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="用户表"';
        }
        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(1024)->notNull()->defaultValue('')->comment('用户名'),
            'password' => $this->string(1024)->notNull()->defaultValue('')->comment('密码'),
            'is_delete' => $this->string(30)->notNull()->defaultValue('no')->comment('是否删除'),
            'is_use'    => $this->string(30)->notNull()->defaultValue('yes')->comment('是否启用'),
        ], $tableOptions);
        $this->createIndex('username' ,$this->tableName ,'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin_user}}');
    }
}
