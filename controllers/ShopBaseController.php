<?php declare(strict_types=1);


namespace app\controllers;


use app\dao\ShopUserDao;
use EasyWeChat\Factory;
use Yii;
use yii\web\Controller;

/**
 * 微信公众号商城授权认证
 *
 * Class ShopBaseController
 * @package app\controllers
 * @property string $openid
 */
class ShopBaseController extends Controller
{
    /** @var string $openid */
    public $openid;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        //判断是否为微信客户端访问
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            echo "<script>alert('请用微信客户端访问')</script>";
            die();
        }
        $app   = Factory::officialAccount(Yii::$app->params['testWeChat']);
        // 判断是否存在了openid 如果不存在
        if (empty(Yii::$app->session->get('openid'))) {
            $url   = Yii::$app->request->getUrl();
            $oauth = $app->oauth;
            Yii::$app->session->set('oauth_url',$url);
            $res = $oauth->redirect();
            $res->send();
        }
        // 判断用户是否关注公众号
        $openid = Yii::$app->session->get('openid');
        $useInfo = ShopUserDao::findByOpenId($openid);
        if (empty($useInfo) === true || $useInfo['is_sub'] === 0){
            echo "<script>alert('请先关注公众号,再使用商城')</script>";
            die();
        }
    }
}