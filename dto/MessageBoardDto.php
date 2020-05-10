<?php declare(strict_types=1);


namespace app\dto;

use app\validator\PhoneValidator;

/**
 * 留言板数据验证层
 *
 * Class MessageBoardDto
 * @package app\dto
 * @property string $mail
 */
class MessageBoardDto extends BaseDto
{
    /** @var string $mail */
    public $mail;

    /** @var string $phone */
    public $phone;

    /**
     * Notes:
     * @return array|void
     * @author: chentulin
     * Date: 2020/5/10
     * Time: 21:34
     */
    public function rules()
    {
        return [
            ['mail', 'email','message' => '邮箱号码有误，请重新填写'],
            ['phone',PhoneValidator::class,'message' => '手机号码有误，请重新填写']
        ];
    }
}