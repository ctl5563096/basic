<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m200319_005757_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="文章表"';
        }
        $this->createTable('{{%article}}', [
            'id'           => $this->primaryKey()->comment('文章id'),
            'article_name' => $this->string()->notNull()->defaultValue('')->comment('文章名称'),
            'content'      => $this->text()->defaultValue('')->notNull()->comment('文章内容'),
            'created_at'   => $this->integer()->defaultValue(0)->notNull()->comment('创建时间'),
            'deleted_at'   => $this->integer()->defaultValue(0)->notNull()->comment('删除时间'),
            'is_delete'    => $this->string()->defaultValue('no')->notNull()->comment('是否删除,yes/是,no/否'),
            'see_num'      => $this->integer()->defaultValue(0)->notNull()->comment('观看人数'),
            'is_display'   => $this->string()->defaultValue('yes')->notNull()->comment('是否展示'),
            'author'       => $this->integer()->defaultValue(0)->notNull()->comment('作者')
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
