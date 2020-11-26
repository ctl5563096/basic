<?php

use yii\db\Migration;

/**
 * Class m201110_110541_add_column_chat_message
 */
class m201110_110541_add_column_chat_message extends Migration
{
    public $tableName = '{{%chat_message}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'is_customer',$this->tinyInteger(1)->notNull()->defaultValue(1)->comment('是否是用户发送,1是,2不是'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'is_customer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201110_110541_add_column_chat_message cannot be reverted.\n";

        return false;
    }
    */
}
