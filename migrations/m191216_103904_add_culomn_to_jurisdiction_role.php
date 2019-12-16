<?php

use yii\db\Migration;

/**
 * Class m191216_103904_add_culomn_to_jurisdiction_role
 */
class m191216_103904_add_culomn_to_jurisdiction_role extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%role_jurisdiction}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'role_name' , $this->string()->notNull()->defaultValue('')->comment('权限名字'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'role_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191216_103904_add_culomn_to_jurisdiction_role cannot be reverted.\n";

        return false;
    }
    */
}
