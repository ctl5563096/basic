<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_comment}}`.
 */
class m200507_060340_create_article_comment_table extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%article_comment}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="文章评论表"';
        }
        $this->createTable($this->tableName, [
            'id'         => $this->primaryKey(),
            'comment'    => $this->string()->defaultValue('')->notNull()->comment('文章评论内容'),
            'created_at' => $this->integer()->defaultValue(0)->notNull()->comment('评论时间'),
            'is_delete'  => $this->tinyInteger()->defaultValue(0)->notNull()->comment('是否删除'),
            'article_id' => $this->integer()->defaultValue(0)->notNull()->comment('所属文章id'),
            'ip'         => $this->string()->defaultValue('127.0.0.1')->notNull()->comment('评论人的ip地址'),
            'user_name'  => $this->string()->defaultValue('')->notNull()->comment('评论人昵称'),
            'user_id'    => $this->integer()->defaultValue(0)->notNull()->comment('评论人id 0就是游客评论')
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
