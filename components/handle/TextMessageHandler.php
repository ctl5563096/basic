<?php declare(strict_types=1);


namespace app\components\handle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 文本消息事件处理器
 *
 * Class TextMessageHandler
 * @package app\components\handle
 * @property array $message
 */
class TextMessageHandler implements EventHandlerInterface
{
    /** @var array $message */
    public $message;

    /**
     * @inheritDoc
     */
    public function handle($payload = null)
    {
        $this->message = $payload;
        // 处理事件
        switch ($this->message['MsgType']){
            case 'text':
                return $this->message['Content'];
                break;
            case 'image':
                return '收到了您反馈的图片';
                break;
            default:
                return '很高兴收到您的消息';
        }
    }
}