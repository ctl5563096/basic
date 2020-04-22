<?php declare(strict_types=1);


namespace app\commands;

use app\components\mq\DelayMq;
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
        $client = new RabbitMq('guest','guest','127.0.0.1',5672);
        $callback = static function(AMQPMessage $msg){
            sleep(20);
            echo $msg->body;
//            var_dump($msg->body);die;
//            sleep(20);
            // 处理消费队列消费的逻辑
//            echo json_decode($msg->body,true);
        };
        $client->consumeMessage('Yii',$callback);
    }

    /**
     * 延时消费
     *
     * Date: 2020/3/26
     * @throws \Exception
     * @author chentulin
     */
    public function actionDelay()
    {
        $client = new DelayMq('guest','guest','127.0.0.1',5672,20000);
        $callback = static function(AMQPMessage $msg){
            echo date('Y-m-d H:i:s'). ' [x] Received',$msg->body,PHP_EOL;

            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);

        };
        $client->dealMessage('delay_exchange',$callback,'cache_exchange');
    }
}