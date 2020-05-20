<?php declare(strict_types=1);

namespace app\controllers\backend;

use EasyWeChat\Factory;
use Yii;
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
        $app   = Factory::officialAccount(Yii::$app->params['testWeChat']);
        $cache = Yii::$app->cache;
        var_dump($cache);die();
        // 替换easyWeChat的的缓存
        $app->rebind('cache',$cache);
        $response = $app->server->serve();
        $app->server->push(function ($message) {
            if ($message['MsgType'] === 'event') {
                Yii::info(json_encode($message));
            }
        });

        $response = $app->server->serve();
        $response->send();
        exit;
    }
}