<?php

use yii\db\Migration;

/**
 * Class m191212_054750_create_username_index_to_admin_user
 */
class m191212_054750_create_username_index_to_admin_user extends Migration
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
        $this->alterColumn($this->tableName ,'username' ,$this->string(256));
        $this->createIndex('unq_username', $this->tableName,['username'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('unq_username' ,$this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191212_054750_create_username_index_to_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
