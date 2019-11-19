<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use EasyWeChat\Factory;
use app\components\facade\JssdkFacade;
use app\components\until\WechatUntil;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
	$config = [
    		'app_id' => 'wxc439cbfe9ee8140e',
    		'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
    		'token' => 'chentulin',
    		'response_type' => 'array',
    		//...
	];
	$app = Yii::$app->wechat::officialAccount($config);
        $app->server->push(function ($message) {
        // $message['FromUserName'] // 用户的 openid
        // $message['MsgType'] // 消息类型：event, text....i
        return "您好！欢迎使用 EasyWeChat";
    });
	$response = $app->server->serve();
	$response->send();
	return $response;
    }

   public function actionCom(){
	$app = Yii::$app->MyClass;
	var_dump($app);
   }

   public function actionDi()
   {
      $config = [
                'app_id' => 'wxc439cbfe9ee8140e',
                'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
                'token' => 'chentulin',
                'response_type' => 'array',
                //...
        ];
      $obj = Factory::make('officialAccount',$config);
      var_dump($obj);die;
      $app =  Yii::$container->get(Factory::class);
      var_dump($app);
   }

   public function actionFacade()
   {
        $obj = JssdkFacade::getSdkConfig();
        var_dump($obj);die();
   }

    /**
     * 获取access_token
     * Date: 2019/11/10
     * Author: ctl
     */
   public function actionToken()
   {
       $app = JssdkFacade::getSdkConfig();
       $accessToken = $app->access_token;
       $token = $accessToken->getToken();
       var_dump($token);die();
   }

   public function actionRes()
   {
       $app = JssdkFacade::getSdkConfig();
       $var = 1;
       var_dump($app->server);die();
       $app->server->push(function ($message) {
           Yii::info(1111111);
           // $message['FromUserName'] // 用户的 openid
           // $message['MsgType'] // 消息类型：event, text....
           return "您好！欢迎使用 EasyWeChat";
       });
       $response = $app->server->serve();
       $response->send();
   }

    /**
     * 校验通信
     * Date: 2019/11/19
     * Author: ctl
     */
   public function checkSignature()
   {
       $signature = $_GET["signature"];
       $timestamp = $_GET["timestamp"];
       $nonce = $_GET["nonce"];
       $tmpArr = array(TOKEN, $timestamp, $nonce);
       //对索引数组进行升序排序，并返回由数组元素组合成的字符串
       sort($tmpArr,SORT_STRING);
       $tmpStr = implode($tmpArr);
       //进行shal加密
       $tmpStr = sha1($tmpStr);
       if($tmpStr == $signature){
           return true;
       }else{
           return false;
       }
   }

    /**
     * 验证
     * Date: 2019/11/19
     * Author: ctl
     */
   public function actionGo()
   {
       //设定通讯令牌，token为服务号的唯一标识
       define('TOKEN', $_GET['token']);
       //判断是不是第一次通讯，如果是就直接校验
       if (isset($_GET['echostr'])) {
           $echoStr = $_GET['echostr'];
           if ($this->checkSignature()) {
               echo $echoStr;
               exit;
           }
       } else {
           $this->responseMsg();
       }
   }

    /**
     * 响应并返回消息
     * Date: 2019/11/19
     * Author: ctl
     */
   public function responseMsg()
   {
       $app = JssdkFacade::getSdkConfig();
       $app->server->push(function ($msg){
           return "您好！欢迎使用 EasyWeChat";
       });
       $response = $app->server->serve();
       $response->send();
   }
}
