<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_record".
 *
 * @property int $id
 * @property string $ip 文章评论内容
 * @property int $access_time 评论时间
 * @property string $access_url 访问路由
 */
class AccessRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_time'], 'integer'],
            [['ip', 'access_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'access_time' => 'Access Time',
            'access_url' => 'Access Url',
        ];
    }
}
