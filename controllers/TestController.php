<?php declare(strict_types=1);


namespace app\controllers;

use app\components\mq\DelayMq;
use app\components\mq\RabbitMq;
use yii\web\Controller;

/**
 * 测试控制器
 *
 * Class TestController
 * @package app\controllers
 */
class TestController extends Controller
{
    /**
     * 消费队列
     *
     * Date: 2020/5/16
     * @author chentulin
     * @throws \Exception
     */
    public function actionTest()
    {
        $connection = new RabbitMq('guest','guest','127.0.0.1',5672);
        $connection->sendMessage("测试\n");
    }

    /**
     * 延迟队列
     *
     * Date: 2020/5/16
     * @author chentulin
     */
    public function actionDelay()
    {
        $connection = new DelayMq('guest','guest','127.0.0.1',5672,20000);
        $connection->sendDelayMessage('测试延迟队列');
    }
}
