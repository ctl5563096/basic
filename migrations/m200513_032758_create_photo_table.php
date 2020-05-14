<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photo}}`.
 */
class m200513_032758_create_photo_table extends Migration
{
    public $tableName = '{{%photo}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="相册表"';
        }
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'url'         => $this->string()->defaultValue('')->notNull()->comment('图片地址'),
            'upload_time' => $this->integer()->defaultValue(0)->notNull()->comment('上传时间'),
            'type'        => $this->string()->defaultValue('')->notNull()->comment('类型,技术/technology,生活/life,个人/personal,/旅游travel'),
            'content'     => $this->string()->defaultValue('')->notNull()->comment('图片摘要')
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%photo}}');
    }
}
