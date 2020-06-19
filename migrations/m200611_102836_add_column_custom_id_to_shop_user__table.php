<?php

use yii\db\Migration;

/**
 * Class m200611_102836_add_column_custom_id_to_shop_user__table
 */
class m200611_102836_add_column_custom_id_to_shop_user__table extends Migration
{
    public $tableName = '{{%shop_user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'custom_id',$this->integer()->notNull()->defaultValue(14)->comment('客服id'));
        $this->createIndex('idx_custom_id',$this->tableName,'custom_id',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'custom_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200611_102836_add_column_custom_id_to_shop_user__table cannot be reverted.\n";

        return false;
    }
    */
}
