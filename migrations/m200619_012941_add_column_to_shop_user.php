<?php

use yii\db\Migration;

/**
 * Class m200619_012941_add_column_to_shop_user
 */
class m200619_012941_add_column_to_shop_user extends Migration
{
    public $tableName = '{{%shop_user}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'nickname',$this->string()->notNull()->defaultValue('')->comment('昵称'));
        $this->addColumn($this->tableName,'sex',$this->tinyInteger(4)->notNull()->defaultValue(0)->comment('性别 1是男 2是女 0是未知'));
        $this->addColumn($this->tableName,'city',$this->string()->notNull()->defaultValue('')->comment('城市'));
        $this->addColumn($this->tableName,'province',$this->string()->notNull()->defaultValue('')->comment('省份'));
        $this->addColumn($this->tableName,'country',$this->string()->notNull()->defaultValue('')->comment('国家'));
        $this->addColumn($this->tableName,'head_img_url',$this->string()->notNull()->defaultValue('')->comment('头像地址'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'nickname');
        $this->dropColumn($this->tableName,'sex');
        $this->dropColumn($this->tableName,'city');
        $this->dropColumn($this->tableName,'province');
        $this->dropColumn($this->tableName,'country');
        $this->dropColumn($this->tableName,'head_img_url');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200619_012941_add_column_to_shop_user cannot be reverted.\n";

        return false;
    }
    */
}
