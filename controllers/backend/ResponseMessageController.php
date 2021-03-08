<?php declare(strict_types=1);

namespace app\controllers\backend;

use app\components\handle\EventHandler;
use app\components\handle\TextMessageHandler;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Message;
use Yii;
use app\components\EasyWeChatCache;
use yii\web\Controller;

/**
 * 微信响应 入口
 *
 * Class ResponseMessageController
 * @package app\controllers\backend
 */
class ResponseMessageController extends Controller
{
    /**
     * Notes: 微信主入口
     * @author: chentulin
     * Date: 2020/5/20
     * Time: 12:39
     */
    public function actionIndex()
    {
        $app    = Factory::officialAccount(Yii::$app->params['testWeChat']);
        $config = Yii::$app->params['redis'];
        $cache  = new EasyWeChatCache($config['host'], $config['port'], $config['password']);
        // 替换easyWeChat的的缓存
        $app->rebind('cache', $cache);
        // 注册消息事件处理器
        $app->server->push(EventHandler::class,Message::EVENT);
        // 注册文本图片事件处理器
        $app->server->push(TextMessageHandler::class, Message::TEXT | Message::IMAGE);
        // 推送消息
        $response = $app->server->serve();
        $response->send();
        exit;
    }
}
