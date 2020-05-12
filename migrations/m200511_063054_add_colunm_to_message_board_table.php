<?php

use yii\db\Migration;

/**
 * Class m200511_063054_add_colunm_to_message_board_table
 */
class m200511_063054_add_colunm_to_message_board_table extends Migration
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
        $this->addColumn($this->tableName, 'reply_time' , $this->integer()->comment('回复时间'));
        $this->addColumn($this->tableName, 'reply_content' , $this->string()->notNull()->defaultValue('')->comment('回复内容'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'reply_time');
        $this->dropColumn($this->tableName ,'reply_content');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200511_063054_add_colunm_to_message_board_table cannot be reverted.\n";

        return false;
    }
    */
}
