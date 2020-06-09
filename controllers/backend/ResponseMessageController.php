<?php declare(strict_types=1);

namespace app\controllers\backend;

use app\components\handle\EventHandler;
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
        $accessToken = $app->access_token;
        $token = $accessToken->getToken(); // token 数组  token['access_token'] 字符串
        Yii::info('用户openid' . $token);
//        $app->server->push(static function ($message) {
//            if ($message['MsgType'] === 'event') {
//                // 关注之后,新增用户
//                if ($message['Event'] === 'subscribe'){
//
//                }
//            }
//        });
        // 注册消息事件处理器
        $app->server->push(EventHandler::class,Message::EVENT);

        $response = $app->server->serve();
        $response->send();
        exit;
    }
}