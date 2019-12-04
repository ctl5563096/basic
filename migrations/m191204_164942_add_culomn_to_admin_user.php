<?php

use yii\db\Migration;

/**
 * Class m191204_164942_add_culomn_to_admin_user
 */
class m191204_164942_add_culomn_to_admin_user extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%admin_user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'phonenumber' , $this->integer(11)->comment('注册手机号码'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'phonenumber');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191204_164942_add_culomn_to_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
