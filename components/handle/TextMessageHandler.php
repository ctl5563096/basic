<?php declare(strict_types=1);


namespace app\components\handle;

use app\dao\ShopUserDao;
use app\models\ChatMessage;
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
        $customId = ShopUserDao::findByOpenId($this->message['FromUserName'])['custom_id'];
        // 处理事件
        switch ($this->message['MsgType']) {
            case 'text':
                $res      = rpcClient::rpcClient(
                    'tcp://' . Yii::$app->params['rpc']['host'] . ':' . Yii::$app->params['rpc']['port'],
                    'App\Rpc\Lib\CustomInterface',
                    'send',
                    [
                        $customId,
                        'text',
                        $this->message['Content'],
                        $this->message['FromUserName'],
                    ]
                );
                // 聊天记录暂时存到mysql 以保证聊天记录的对比
                $messageModel              = new ChatMessage();
                $messageModel->content     = $this->message['Content'];
                $messageModel->openid      = $this->message['FromUserName'];
                $messageModel->is_read     = 1;
                $messageModel->custom_id   = $customId;
                $messageModel->type        = 'text';
                $messageModel->is_customer = 1;
                $messageModel->save();
                Yii::info(json_encode($res));
                if ($res['result'] === false) {
                    return '小客不在线哦,上线之后马上回复客官您';
                }
                // redis实例化对象
                // 记录在两小时内 是否发送过消息 如果没有就返回 否则就不返回
//                $redis = Yii::$app->redis;
//                $key = $this->message['FromUserName'];
//                if (!$redis->get($this->message['FromUserName'])) {
//                    $redis->set($key, 'yes');
//                    $redis->expire($key, 7200);
//                    return '您的专属客服马上为你处理您的问题哦!';
//                }
                break;
            case 'image':
                $res      = rpcClient::rpcClient(
                    'tcp://' . Yii::$app->params['rpc']['host'] . ':' . Yii::$app->params['rpc']['port'],
                    'App\Rpc\Lib\CustomInterface',
                    'send',
                    [
                        $customId,
                        'image',
                        $this->message['PicUrl'],
                        $this->message['FromUserName'],
                    ]
                );
                // 聊天记录暂时存到mysql 以保证聊天记录的对比
                $messageModel              = new ChatMessage();
                $messageModel->content     = $this->message['PicUrl'];
                $messageModel->openid      = $this->message['FromUserName'];
                $messageModel->is_read     = 1;
                $messageModel->custom_id   = $customId;
                $messageModel->type        = 'image';
                $messageModel->is_customer = 1;
                $messageModel->save();
                Yii::info(json_encode($res));
                if ($res['result'] === false) {
                    return '小客不在线哦,上线之后马上回复客官您';
                }
                break;
            default:
                return '很高兴收到您的消息';
        }
    }
}