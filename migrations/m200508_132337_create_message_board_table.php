<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message_board}}`.
 */
class m200508_132337_create_message_board_table extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%message_board}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="留言板"';
        }
        $this->createTable($this->tableName, [
            'id'         => $this->primaryKey(),
            'content'    => $this->string()->defaultValue('')->notNull()->comment('留言内容'),
            'created_at' => $this->integer()->defaultValue(0)->notNull()->comment('留言时间'),
            'name'       => $this->string()->defaultValue('')->notNull()->comment('留言人'),
            'is_read'    => $this->integer()->defaultValue(0)->notNull()->comment('是否查看 0/是没有查看 1是已经查看'),
            'is_reply'   => $this->integer()->defaultValue(0)->notNull()->comment('是否回复 0/是没有回复 1是已经回复'),
            'is_delete'  => $this->integer()->defaultValue(0)->notNull()->comment('是否删除 0/是没有删除 1是已经删除'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message_board}}');
    }
}
