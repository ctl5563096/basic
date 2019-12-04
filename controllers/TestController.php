<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $config = [
            'app_id' => 'wxc439cbfe9ee8140e',
            'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
            'token' => 'chentulin',
            'response_type' => 'array',
            //...
        ];
        $app = Yii::$app->wechat::officialAccount($config);
        $users = $app->user->list;
        var_dump($users);
    }
}