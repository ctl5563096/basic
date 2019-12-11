<?php

use yii\db\Migration;

/**
 * Class m191211_142755_add_culomn_admin_user_role
 */
class m191211_142755_add_culomn_admin_user_role extends Migration
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
        $this->addColumn($this->tableName, 'role_id' , $this->integer(11)->notNull()->defaultValue(0)->comment('角色Id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'role_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191211_142755_add_culomn_admin_user_role cannot be reverted.\n";

        return false;
    }
    */
}
