<?php declare(strict_types=1);


namespace app\service;


use Yii;

class BaseService
{
    public function __construct()
    {
        $this->response = Yii::$app->response;
    }
}