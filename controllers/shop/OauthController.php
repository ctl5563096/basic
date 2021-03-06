<?php declare(strict_types=1);


namespace app\controllers\shop;


use EasyWeChat\Factory;
use Yii;
use yii\web\Controller;

/**
 * 授权成功回调方法
 *
 * Class OauthController
 * @package app\controllers\shop
 */
class OauthController extends Controller
{
    /**
     * 授权成功回调方法
     *
     * Date: 2020/6/9
     * @author chentulin
     */
    public function actionOauth()
    {
        $app = Factory::officialAccount(Yii::$app->params['testWeChat']);
        $oauth = $app->oauth;
        $openid = $oauth->user()->getId();
        // 存储用户的openid
        Yii::$app->session->set('openid',$openid);
        // 重定向url
        $url = Yii::$app->session->get('oauth_url');
        // 回调成功后重新访问原页面
        return $this->redirect($url);
    }
}