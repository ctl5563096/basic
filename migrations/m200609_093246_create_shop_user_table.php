<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_user}}`.
 */
class m200609_093246_create_shop_user_table extends Migration
{
    public $tableName = '{{%shop_user}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB COMMENT="商城用户表"';
        }
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey()->notNull()->comment('用户id'),
            'openid'      => $this->string()->defaultValue('')->notNull()->comment('openid'),
            'is_sub'      => $this->tinyInteger(4)->defaultValue(1)->notNull()->comment('是否关注 0是未关注 1是已关注'),
            'un_sub_time' => $this->integer()->defaultValue(0)->notNull()->comment('用户取关时间'),
            'is_black'    => $this->tinyInteger(4)->defaultValue(0)->notNull()->comment('是否为黑名单'),
            'sub_time'    => $this->integer()->defaultValue(0)->notNull()->comment('用户关注时间'),
            'created_at'  => $this->integer()->defaultValue(0)->notNull()->comment('创建时间')
        ], $tableOptions);
        $this->createIndex('openid',$this->tableName,'openid',false);
        $this->createIndex('sub_time',$this->tableName,'sub_time',false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
