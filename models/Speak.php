<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%speak}}".
 *
 * @property int $id
 * @property int $created_at 发布时间
 * @property string $content 内容
 */
class Speak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%speak}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => '发布时间',
            'content' => '内容',
        ];
    }
}
