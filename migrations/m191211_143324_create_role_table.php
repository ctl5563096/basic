<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m191211_143324_create_role_table extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%role}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="角色表"';
        }
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'role_name' => $this->string(1024)->notNull()->defaultValue('')->comment('角色名'),
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
