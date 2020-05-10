<?php declare(strict_types=1);


namespace app\validator;


use yii\validators\Validator;

/**
 * 手机验证器
 *
 * Class PhoneValidator
 * @package app\validator
 */
class PhoneValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!$this->validatePhone($model->$attribute)) {
            $this->addError($model, $attribute, $attribute . '手机号输入错误');
        }
    }

    /**
     * Notes: 正则验证手机
     * @param string $phone
     * @return bool
     * @author: chentulin
     * Date: 2020/5/10
     * Time: 22:16
     */
    public function validatePhone(string  $phone): bool
    {
        $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/";
        if(preg_match($chars, $phone) === 0) {
            return false;
        }
        return true;
    }
}