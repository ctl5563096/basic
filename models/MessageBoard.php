<?php declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "message_board".
 *
 * @property int $id
 * @property string $content 留言内容
 * @property int $created_at 留言时间
 * @property string $name 留言人
 * @property int $is_read 是否查看 0/是没有查看 1是已经查看
 * @property int $is_reply 是否回复 0/是没有回复 1是已经回复
 * @property int $is_delete 是否删除 0/是没有删除 1是已经删除
 * @property int $mail 邮箱
 * @property int $phone 邮箱
 */
class MessageBoard extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message_board';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'is_read', 'is_reply', 'is_delete'], 'integer'],
            [['content', 'name' , 'mail' , 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'name' => 'Name',
            'is_read' => 'Is Read',
            'is_reply' => 'Is Reply',
            'is_delete' => 'Is Delete',
        ];
    }
}
