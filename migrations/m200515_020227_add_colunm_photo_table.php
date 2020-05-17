<?php

use yii\db\Migration;

/**
 * Class m200515_020227_add_colunm_photo_table
 */
class m200515_020227_add_colunm_photo_table extends Migration
{
    public $tableName = '{{%photo}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'thumb_url' , $this->string()->notNull()->defaultValue('')->comment('生成缩略图'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'thumb_url');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200515_020227_add_colunm_photo_table cannot be reverted.\n";

        return false;
    }
    */
}
