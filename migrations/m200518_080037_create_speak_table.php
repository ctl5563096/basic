<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%speak}}`.
 */
class m200518_080037_create_speak_table extends Migration
{
    public $tableName = '{{%speak}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="说点什么表"';
        }
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'created_at'  => $this->integer()->defaultValue(0)->notNull()->comment('发布时间'),
            'content'     => $this->string()->defaultValue('')->notNull()->comment('内容')
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%speak}}');
    }
}
