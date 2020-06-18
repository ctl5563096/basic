<?php declare(strict_types=1);


namespace app\components\handle;

use app\dao\ShopUserDao;
use Yii;
use app\components\rpcClient;
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
     * @throws \Exception
     */
    public function handle($payload = null)
    {
        $this->message = $payload;
        // 处理事件
        switch ($this->message['MsgType']){
            case 'text':
                $customId = ShopUserDao::findByOpenId($this->message['FromUserName'])['custom_id'];
                $res = rpcClient::rpcClient(
                    'tcp://' . Yii::$app->params['rpc']['host'] . ':' . Yii::$app->params['rpc']['port'],
                    'App\Rpc\Lib\CustomInterface',
                    'send',
                    [
                        $customId,
                        'text',
                        $this->message['Content'],
                        $this->message['FromUserName']
                    ]
                );
                Yii::info(json_encode($res));
                if ($res['result'] === false){
                    return '小客不在线哦,上线之后马上回复客官您';
                }
                break;
            case 'image':
                return '收到了您反馈的图片';
                break;
            default:
                return '很高兴收到您的消息';
        }
    }
}