<?php

use yii\db\Migration;

/**
 * Class m200509_080944_add_column_message_table
 */
class m200509_080944_add_column_message_table extends Migration
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
        $this->addColumn($this->tableName, 'mail' , $this->string()->notNull()->defaultValue('')->comment('邮箱'));
        $this->addColumn($this->tableName, 'phone' , $this->string()->notNull()->defaultValue('')->comment('电话号码'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'mail');
        $this->dropColumn($this->tableName ,'phone');
    }
}
