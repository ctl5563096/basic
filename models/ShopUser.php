<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_user".
 *
 * @property int $id 用户id
 * @property string $openid openid
 * @property int $is_sub 是否关注 0是未关注 1是已关注
 * @property int $un_sub_time 用户取关时间
 * @property int $is_black 是否为黑名单
 * @property int $sub_time 用户关注时间
 * @property int $created_at 创建时间
 * @property int $custom_id 客服id
 */
class ShopUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_sub', 'un_sub_time', 'is_black', 'sub_time', 'created_at', 'custom_id'], 'integer'],
            [['openid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'openid'      => 'Openid',
            'is_sub'      => 'Is Sub',
            'un_sub_time' => 'Un Sub Time',
            'is_black'    => 'Is Black',
            'sub_time'    => 'Sub Time',
            'created_at'  => 'Created At',
            'custom_id'   => '客服id',
        ];
    }
}
