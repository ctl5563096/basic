<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m191204_061433_create_user_table extends Migration
{
    public $tableName = '{{%user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="用户表"';
        }
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'openid' => $this->string(1024)->notNull()->defaultValue('')->comment('用户的openid'),
            'created_time' => $this->integer(11)->notNull()->defaultValue(0)->comment('创建时间'),
            'subscribe' => $this->string()->notNull()->defaultValue('yes')->comment('yes/是关注 no/是取关'),
            'subscribe_time' => $this->integer(11)->notNull()->defaultValue('0')->comment('关注时间'),
            'unsubscribe_time' => $this->integer(11)->notNull()->defaultValue('0')->comment('取消关注时间'),
            'heading_url' => $this->string(1024)->notNull()->defaultValue('')->comment('头像地址'),
            'nick_name' => $this->string(1024)->notNull()->defaultValue('')->comment('用户昵称'),
        ],$tableOptions);
        $this->createIndex('index_nick_name' ,$this->tableName ,'nick_name');
        $this->createIndex('index_openid' ,$this->tableName ,'openid');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
