<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\components\mq\RabbitMq;
use yii\web\Controller;

/**
 * 测试控制器
 *
 * Class TestController
 * @package app\controllers\backend
 */
class TestController extends Controller
{
    /**
     * 测试消息队列方法
     *
     * Date: 2020/3/30
     * @throws \Exception
     * @author chentulin
     */
    public function actionIndex()
    {
        \Yii::$app->test->test();
        $client = new RabbitMq('guest','guest','127.0.0.1',5672);
        $client->sendMessage('测试消息');

        var_dump('发送完毕');
    }
}