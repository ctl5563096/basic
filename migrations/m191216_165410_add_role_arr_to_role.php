<?php

use yii\db\Migration;

/**
 * Class m191216_165410_add_role_arr_to_role
 */
class m191216_165410_add_role_arr_to_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('role', 'role_arr' , $this->string()->notNull()->defaultValue('')->comment('权限数组'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('role' ,'role_arr');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191216_165410_add_role_arr_to_role cannot be reverted.\n";

        return false;
    }
    */
}
