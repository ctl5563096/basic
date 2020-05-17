<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property string $url 图片地址
 * @property int $upload_time 上传时间
 * @property string $type 类型,技术/technology,生活/life,个人/personal,/旅游travel
 * @property string $content 图片摘要
 * @property string $thumb_url 缩略图url
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['upload_time'], 'integer'],
            [['url', 'type', 'content' ,'thumb_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'url'         => 'Url',
            'upload_time' => 'Upload Time',
            'type'        => 'Type',
            'content'     => 'Content',
        ];
    }
}
