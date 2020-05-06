<?php

use yii\db\Migration;

/**
 * Class m200506_214740_add_column_article_table
 */
class m200506_214740_add_column_article_table extends Migration
{
    public $tableName = '{{%article}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'like' , $this->integer()->notNull()->defaultValue(0)->comment('点赞数'));
        $this->addColumn($this->tableName, 'hate' , $this->integer()->notNull()->defaultValue(0)->comment('踩数'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName ,'like');
        $this->dropColumn($this->tableName ,'hate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200506_214740_add_column_article_table cannot be reverted.\n";

        return false;
    }
    */
}
