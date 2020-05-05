<?php declare(strict_types=1);


namespace app\dto;


use yii\base\Model;

/**
 * Dto数据验证基类
 *
 * Class BaseDto
 * @package app\dto
 */
class BaseDto extends Model
{
    /**
     * 验证错误后返回错误
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function afterValidate()
    {
        if ($this->getFirstErrors()){
            exit(json_encode([
                'code' => 400,
                'msg'  => current($this->getFirstErrors()),
            ]));
        }
    }
}