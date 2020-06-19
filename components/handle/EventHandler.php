<?php declare(strict_types=1);


namespace app\components\handle;

use app\dao\ShopUserDao;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 微信事件处理器
 *
 * Class EventHandler
 * @package app\components\handle
 * @property array $message
 */
class EventHandler implements EventHandlerInterface
{
    /** @var array $message */
    public $message;

    /**
     * @inheritDoc
     */
    public function handle($payload = null)
    {
        $dao = new ShopUserDao();
        $this->message = $payload;

        // 处理关注或者取关事件
        $event = $this->message['Event'];

        // 关注之后新建用户
        if ($event === 'subscribe'){
            // 判断用户是否曾经关注过
            $userInfo = ShopUserDao::findOne(['openid' => $this->message['FromUserName']]);
            if (!$userInfo){
                if (!$dao->createShopUser($this->message)){
                    \Yii::info($dao->createShopUser($this->message));
                    return null;
                }
                return '欢迎关注';
            }
            $dao->is_sub = 1;
            $dao->save();
            return '欢迎再次关注';
        }elseif ($event === 'unsubscribe'){
            // 取关事件
            $dao->unSubscribeStatus($this->message['FromUserName']);
            return null;
        }

    }
}