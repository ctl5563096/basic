<?php declare(strict_types=1);


namespace app\commands;

use app\components\mq\RabbitMq;
use PhpAmqpLib\Message\AMQPMessage;
use yii\console\Controller;

/**
 * 消息队列消费者端
 *
 * Class ConsumeContronller
 * @package app\commands
 */
class ConsumeController extends Controller
{
    /**
     * 消费者主方法
     *
     * Date: 2020/3/23
     * @throws \ErrorException
     * @author chentulin
     */
    public function actionRun()
    {
        $client = new RabbitMq('guest','guest','127.0.0.1',5673);
        $callback = static function(AMQPMessage $msg){
            // 处理消费队列消费的逻辑
            echo json_decode($msg->body,true)['test'];
        };
        $client->consumeMessage('Yii',$callback);
    }
}