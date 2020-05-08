<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%access_record}}`.
 */
class m200508_004438_create_access_record_table extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%access_record}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="博客访问表"';
        }
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'ip'          => $this->string()->defaultValue('')->notNull()->comment('文章评论内容'),
            'access_time' => $this->integer()->defaultValue(0)->notNull()->comment('评论时间'),
            'access_url'  => $this->string()->defaultValue('')->notNull()->comment('访问路由'),
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
