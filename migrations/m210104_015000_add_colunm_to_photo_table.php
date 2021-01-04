<?php

use yii\db\Migration;

/**
 * Class m210104_015000_add_colunm_to_photo_table
 */
class m210104_015000_add_colunm_to_photo_table extends Migration
{
    public $tableName = '{{%photo}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'is_index' , $this->tinyInteger(1)->notNull()->defaultValue(1)->comment('是否为轮播图,1/不是,2/是')->after('type'));
        $this->addColumn($this->tableName, 'article' , $this->text()->notNull()->defaultValue('')->comment('图片文章'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'is_index');
        $this->dropColumn($this->tableName ,'article');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210104_015000_add_colunm_to_photo_table cannot be reverted.\n";

        return false;
    }
    */
}
