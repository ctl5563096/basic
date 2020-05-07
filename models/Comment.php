<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article_comment}}".
 *
 * @property int $id
 * @property string $comment 文章评论内容
 * @property int $created_at 评论时间
 * @property int $is_delete 是否删除
 * @property int $article_id 所属文章id
 * @property string $ip 评论人的ip地址
 * @property string $user_name 评论人昵称
 * @property int $user_id 评论人id 0就是游客评论
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'is_delete', 'article_id', 'user_id'], 'integer'],
            [['comment', 'ip', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'comment'    => '文章评论内容',
            'created_at' => '评论时间',
            'is_delete'  => '是否删除',
            'article_id' => '所属文章id',
            'ip'         => '评论人的ip地址',
            'user_name'  => '评论人昵称',
            'user_id'    => '评论人id 0就是游客评论',
        ];
    }
}
