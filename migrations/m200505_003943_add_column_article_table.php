<?php

use yii\db\Migration;

/**
 * Class m200505_003943_add_column_article_table
 */
class m200505_003943_add_column_article_table extends Migration
{
    public $tableName = '{{%article}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'module' , $this->string()->notNull()->defaultValue('personal')->comment('文章模块'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'module');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200505_003943_add_column_article_table cannot be reverted.\n";

        return false;
    }
    */
}
