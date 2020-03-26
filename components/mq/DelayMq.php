<?php declare(strict_types=1);


namespace app\components\mq;

use Closure;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

/**
 * 延迟队列:实现原理利用rabbitMq的死信交换机
 * 重写rabbitMq类
 *
 * Class DelayMq * @package app\components\mq
 * @property integer $ttlTime
 * @property string $delayExchangeName
 * @property string $delayQueueName
 */
class DelayMq extends RabbitMq
{
    /** @var integer $ttlTime */
    public $ttlTime;

    /** @var string $delayExchangeName */
    public $delayExchangeName;

    /** @var string  $delayQueueName*/
    public $delayQueueName;

    public function __construct(string $username, string $password, string $host, int $port, int $time)
    {
        parent::__construct($username, $password, $host, $port);
        $this->ttlTime = $time;
//        $this->delayExchangeName = $delayExchangeName;
    }

    /**
     * 延迟队列消息
     *
     * Date: 2020/3/26
     * @param string $message
     * @throws \Exception
     * @author chentulin
     */
    public function sendDelayMessage(string $message): void
    {
        // 创建信道
        $channel = $this->connection->channel();

        // 创建直连交换 如果不知道什么用去看看rabbitMq文档
        $channel->exchange_declare('delay_exchange', 'direct',false,false,false);
        // 创建延迟处理队列 死信队列实现了过期机制 然后把消息发送到正常的路由 由正常的路由发送到处理队列
        $channel->exchange_declare('cache_exchange', 'direct',false,false,false);

        // 消息体参数对象
        $tale = new AMQPTable();
        // 交换机
        $tale->set('x-dead-letter-exchange', 'delay_exchange');
        // 路由关键字
        $tale->set('x-dead-letter-routing-key','delay_exchange');
        // 设置ttl时间
        $tale->set('x-message-ttl',$this->ttlTime);

        $channel->queue_declare('cache_queue',false,true,false,false,false,$tale);
        $channel->queue_bind('cache_queue', 'cache_exchange','cache_exchange');

        $msg = new AMQPMessage($message,array(
            'expiration' => (int)$this->ttlTime,
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ));

        $channel->basic_publish($msg,'cache_exchange','cache_exchange');
        echo date('Y-m-d H:i:s')." [x] Sent 'Hello World!' ".PHP_EOL;
        $channel->close();
        $this->connection->close();
    }

    /**
     * 处理过期业务
     *
     * Date: 2020/3/26
     * @param string $channel
     * @param Closure $callback
     * @param string $cacheExchange
     * @throws \ErrorException
     * @throws \Exception
     * @author chentulin
     */
    public function dealMessage(string $channel,Closure $callback,string $cacheExchange)
    {
        $client = $this->connection;
        $channelConsume = $client->channel();
        $channelConsume->exchange_declare($channel, 'direct',false,false,false);
        $channelConsume->exchange_declare($cacheExchange, 'direct',false,false,false);
        $channelConsume->queue_declare($channel,false,true,false,false,false);
        $channelConsume->queue_bind($channel, $channel,$channel);

        //只有consumer已经处理并确认了上一条message时queue才分派新的message给它
        $channelConsume->basic_qos(null, 1, null);
        $channelConsume->basic_consume($channel,'',false,false,false,false,$callback);
        while (count($channelConsume->callbacks)) {
            $channelConsume->wait();
        }
        $channelConsume->close();
        $this->connection->close();
    }
}