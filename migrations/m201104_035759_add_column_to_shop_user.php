<?php

use yii\db\Migration;

/**
 * Class m201104_035759_add_column_to_shop_user
 */
class m201104_035759_add_column_to_shop_user extends Migration
{
    public $tableName = '{{%shop_user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'customerService',$this->integer(11)->notNull()->defaultValue(14)->comment('接待客服'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'customerService');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201104_035759_add_column_to_shop_user cannot be reverted.\n";

        return false;
    }
    */
}
