<?php declare(strict_types=1);


namespace app\dto;

/**
 * Class ChatMessageDto
 * @package app\dto
 * @property string $openid openid
 * @property int $custom_id 客服id
 * @property string $created_time 创建时间
 * @property string $type 记录类型
 * @property int $is_read 是否已读,1/未读,2/已读
 * @property string $content 聊天内容
 * @property int $is_customer 是否为客户消息,1/是,2/不是
 */
class ChatMessageDto extends BaseDto
{
    public const SCENARIO_CREATE = 'create';

    /** @var string $openid */
    public $openid;

    /** @var integer $custom_id */
    public $custom_id;

    /** @var string $type */
    public $type;

    /** @var integer $is_read */
    public $is_read;

    /** @var string $content */
    public $content;

    /** @var integer $is_customer */
    public $is_customer;

    public function rules()
    {
        return [
            [['openid','custom_id','type','is_read','content','is_customer'],'required','on' => self::SCENARIO_CREATE],
            [['label'],'safe','on' => self::SCENARIO_CREATE],
        ];
    }
}