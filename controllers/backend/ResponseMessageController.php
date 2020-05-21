<?php declare(strict_types=1);

namespace app\controllers\backend;

use EasyWeChat\Factory;
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
        $response = $app->server->serve();
        $app->server->push(static function ($message) {
            if ($message['MsgType'] === 'event') {
                Yii::info(json_encode($message));
            }
        });

        $response = $app->server->serve();
        $response->send();
        exit;
    }
}