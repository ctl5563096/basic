<?php declare(strict_types=1);


namespace app\service;

use app\models\ChatMessage;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Exceptions\RuntimeException;
use EasyWeChat\Kernel\Messages\Text;
use Yii;

/**
 * 微信接口服务层
 *
 * Class WeChatService
 * @package app\service
 */
class WeChatService extends BaseService
{
    // 微信客户端实例化对象
    public $app;

    public function __construct()
    {
        parent::__construct();
        // 这里获取微信客户端实例化对象
        $this->app = Factory::officialAccount(Yii::$app->params['testWeChat']);
    }

    /**
     * Notes: 获取微信客户端实例化对象
     *
     * Author: chentulin
     * DateTime: 2020/11/6 11:29
     * E-MAIL: <chentulinys@163.com>
     */
    public function getInstance()
    {
        return $this->app;
    }

    /**
     * Notes: 发送消息
     *
     * Author: chentulin
     * DateTime: 2020/11/6 11:30
     * E-MAIL: <chentulinys@163.com>
     * @param string $openid
     * @param int $customId
     * @param string $content
     * @return bool
     */
    public static function sendMessage(string $openid, int $customId, string $content)
    {
        $object  = new self();
        $message = new Text($content);
        try {
            $object->app->customer_service->message($message)->to($openid)->send();
        } catch (InvalidArgumentException $e) {
            Yii::info($e->getMessage() . $openid);
            return false;
        } catch (InvalidConfigException $e) {
            Yii::info($e->getMessage() . $openid);
            return false;
        } catch (RuntimeException $e) {
            Yii::info($e->getMessage() . $openid);
            return false;
        }
        // 保存客服聊天记录
        $messageModel              = new ChatMessage();
        $messageModel->content     = $content;
        $messageModel->openid      = $openid;
        $messageModel->is_read     = 2;
        $messageModel->custom_id   = $customId;
        $messageModel->type        = 'text';
        $messageModel->is_customer = 2;
        $messageModel->save();
        return true;
    }
}