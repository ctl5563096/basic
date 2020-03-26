<?php declare(strict_types=1);

namespace app\components\mq;

use Closure;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * class of rabbitMq
 *
 * Class RabbitMq
 * @package app\components\mq
 * @property string $username
 * @property string $password
 * @property string $host
 * @property AMQPStreamConnection $connection
 * @property integer $port
 */
class RabbitMq
{
    /** @var string $username */
    public $username;

    /** @var string $password */
    public $password;

    /** @var string $host */
    public $host;

    /** @var integer $port */
    public $port;

    /** @var AMQPStreamConnection $connection */
    public $connection;

    /**
     * mq初始化函数
     *
     * RabbitMq constructor.
     * @param string $username
     * @param string $password
     * @param string $host
     * @param int $port
     */
    public function __construct(string $username ,string $password ,string $host,int $port)
    {
        $this->username   = $username;
        $this->password   = $password;
        $this->host       = $host;
        $this->port       = $port;
        // 实例化rabbitMq连接对象支撑接近六万连接
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->username, $this->password);

    }

    /**
     * 消息发布
     *
     * Date: 2020/3/23
     * @param string $message
     * @throws \Exception
     * @author chentulin
     */
    public function sendMessage(string $message)
    {
        $client = $this->connection;
        $msgClient = new AMQPMessage($message);
        $channel = $client->channel();
        $channel->queue_declare('Yii',false,false,false,false);
        $channel->basic_publish($msgClient,'','Yii');
        // 发送完把socket连接关闭
        $channel->close();
        $client->close();
    }

    /**
     * 消息消费
     *
     * Date: 2020/3/23
     * @param string $channel 消息频道需要跟你发布的频道一致 否则无法消费消息
     * @param Closure $callback
     * @throws \ErrorException
     * @throws \Exception
     * @author chentulin
     */
    public function consumeMessage(string $channel,Closure $callback)
    {
        $client = $this->connection;
        $channelConsume = $client->channel();
        $channelConsume->queue_declare('hello', false, false, false, false);
        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
        $channelConsume->basic_consume($channel, '', false, true, false, false, $callback);
        //while判断消息是否已经消费完
        while(count($channelConsume->callbacks)) {
            $channelConsume->wait();
        }

        $channelConsume->close();
        $client->close();

    }
}