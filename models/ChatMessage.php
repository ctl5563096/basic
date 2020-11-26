<?php declare(strict_types=1);

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_message".
 *
 * @property int $id id
 * @property string $openid openid
 * @property int $custom_id 客服id
 * @property string $created_time 创建时间
 * @property string $type 记录类型
 * @property int $is_read 是否已读,1/未读,2/已读
 * @property string $content 聊天内容
 * @property int $is_customer 是否为客户消息,1/是,2/不是
 */
class ChatMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['custom_id', 'is_read', 'is_customer'], 'integer'],
            [['created_time'], 'safe'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['openid'], 'string', 'max' => 300],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'openid'       => 'Openid',
            'custom_id'    => 'Custom ID',
            'created_time' => 'Created Time',
            'type'         => 'Type',
            'is_read'      => 'Is Read',
            'content'      => 'Content',
            'is_customer'  => 'is_customer'
        ];
    }
}
