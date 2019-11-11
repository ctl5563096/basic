<?php declare(strict_types=1);

use EasyWeChat\Factory;
use app\components\infrastructure\service\JssdkService;
use app\components\infrastructure\service\impl\JssdkServiceImpl;


$containerList = [
    JssdkService::class  => JssdkServiceImpl::class,
];
Yii::$container->set(JssdkService::class,JssdkServiceImpl::class);
Yii::$container->set(
    Factory::class,[
        'app_id' => 'wxc439cbfe9ee8140e',
        'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
        'token' => 'chentulin',
        'response_type' => 'array',
    ])
;
