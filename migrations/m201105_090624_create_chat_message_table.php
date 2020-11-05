<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_message}}`.
 */
class m201105_090624_create_chat_message_table extends Migration
{
    public $tableName = '{{%chat_message}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="微信聊天记录表"';
        }
        $this->createTable('{{%chat_message}}', [
            'id'      => $this->primaryKey()->notNull()->comment('id'),
            'openid' => $this->string(300)->notNull()->defaultValue('')->comment('openid'),
            'custom_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('客服id'),
            'created_time' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('创建时间'),
            'type' => $this->string(100)->notNull()->defaultValue('')->comment('记录类型'),
            'is_read' => $this->tinyInteger(1)->notNull()->defaultValue(1)->comment('是否已读,1/未读,2/已读'),
            'content' => $this->text()->notNull()->defaultValue('')->comment('聊天内容')
        ], $tableOptions);
        $this->createIndex('openid',$this->tableName,'openid',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
