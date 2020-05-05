<?php

use yii\db\Migration;

/**
 * Class m200505_025730_add_column_article_table
 */
class m200505_025730_add_column_article_table extends Migration
{
    public $tableName = '{{%article}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'author_nickname' , $this->string()->notNull()->defaultValue('')->comment('作者昵称'));
        $this->addColumn($this->tableName, 'label' , $this->string()->notNull()->defaultValue('')->comment('文章标签 ,为分隔'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'author_nickname');
        $this->dropColumn($this->tableName ,'label');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200505_025730_add_column_article_table cannot be reverted.\n";

        return false;
    }
    */
}
