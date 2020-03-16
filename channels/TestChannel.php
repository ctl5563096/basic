<?php declare(strict_types=1);

namespace app\channels;

use Yii;
use yii\base\BaseObject;
use yiiplus\websocket\ChannelInterface;

class TestChannel extends BaseObject implements ChannelInterface
{

    /**
     * 处理该 channel 的 WebSocket 信息
     *
     * @param integer $fd 客户端连接描述符
     * @param object $data 客户端发送的服务器的消息内容
     * @return array
     */
    public function execute($fd, $data)
    {
        return [
            $fd, // 第一个参数返回客户端ID，多个以数组形式返回
            $data->message // 第二个参数返回需要返回给客户端的消息
        ];
    }

    /**
     * 客户端断开连接触发此方法
     *
     * @param integer $fd 客户端连接描述符
     */
    public function close($fd)
    {
        return;
    }
}