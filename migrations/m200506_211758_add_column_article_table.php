<?php

use yii\db\Migration;

/**
 * Class m200506_211758_add_column_article_table
 */
class m200506_211758_add_column_article_table extends Migration
{
    public $tableName = '{{%article}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'introduction' , $this->string()->notNull()->defaultValue('')->comment('文章简介'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'introduction');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200506_211758_add_column_article_table cannot be reverted.\n";

        return false;
    }
    */
}
