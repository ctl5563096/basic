<?php declare(strict_types=1);


namespace app\controllers\chat;

use app\dao\ChatMessageDao;
use Yii;
use yii\web\Response;
use app\service\WeChatService;

/**
 * 客服聊天控制器
 *
 * Class MessageController
 * @package app\controllers\chat
 * @property ChatMessageDao $messageDao
 */
class MessageController extends BaseChatController
{
    /**
     * @var bool 关闭yii2自带布局
     */
    public $layout = false;

    /**
     * @var ChatMessageDao $messageDao
     */
    public $messageDao;

    /**
     * 初始化构造函数
     *
     * MessageController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->messageDao = new ChatMessageDao();
    }

    /**
     * 渲染聊天页面
     *
     * Date: 2020/6/19
     * @author chentulin
     */
    public function actionIndex()
    {
        // 获取必要参数去前端连接websocket
        $customId = Yii::$app->session->get('customId');
        return $this->render('index', ['customId' => $customId]);
    }

    /**
     * Notes: 发送消息
     *
     * Author: chentulin
     * DateTime: 2020/11/6 11:16
     * E-MAIL: <chentulinys@163.com>
     */
    public function actionSend()
    {
        $request          = Yii::$app->request;
        $response         = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        // 获取openId和customId
        $openid   = $request->post('openid');
        $customId = $request->post('customId');
        $content  = $request->post('content');
        if (!$openid || !$customId || !$content) {
            $response->data = ['code' => '400', 'msg' => '缺少参数'];
        } else {
            // 获取发送内容
            $weChatServiceRes = WeChatService::sendMessage($openid, (int)$customId, $content);
            if ($weChatServiceRes) {
                $response->data = ['code' => '200', 'msg' => '发送成功'];
            } else {
                $response->data = ['code' => '400', 'msg' => '发送失败'];
            }
        }
        return $response;
    }

    /**
     * Notes: 获取未读信息用户
     *
     * Author: chentulin
     * DateTime: 2020/11/12 15:21
     * E-MAIL: <chentulinys@163.com>
     */
    public function actionMessage()
    {
        $request          = Yii::$app->request;
        $response         = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        // 获取客服ID
        $customId = $request->post('customId');
        $params   = [];
        $res      = [];
        if ($request->post('page')) {
            $params['page'] = $request->post('page');
        }
        if (!$customId) {
            $response->data = ['code' => '400', 'msg' => '缺少参数'];
        } else {
            $response->data = ['code' => 200,'data' => $this->messageDao->getNotReadUserMessageRecord((int)$customId, $params) ,'msg' => '获取成功'];
        }
        return $response;
    }

    /**
     * Notes: 获取未读用户所有信息
     *
     * Author: chentulin
     * DateTime: 2021/1/4 17:04
     * E-MAIL: <chentulinys@163.com>
     */
    public function actionGetMessage()
    {
        $request          = Yii::$app->request;
        $response         = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        // 获取客服ID
        $openid = $request->post('openid');
        if (!$openid) {
            $response->data = ['code' => '400', 'msg' => '缺少参数'];
        }else{
            $response->data = ['code' => 200,'data' => $this->messageDao->getUserNotReadMessage($openid) ,'msg' => '获取成功'];
        }
        return $response;
    }

    /**
     * Notes: 改变信息的已读状态
     *
     * Author: chentulin
     * DateTime: 2021/1/7 17:31
     * E-MAIL: <chentulinys@163.com>
     */
    public function actionChangeStatus()
    {
        $request          = Yii::$app->request;
        $response         = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        // 获取客服ID
        $openid = $request->post('openid');
        if (!$openid) {
            $response->data = ['code' => 400, 'msg' => '缺少参数'];
        }else{
            if ($this->messageDao->changeStatus($openid)){
                $response->data = ['code' => 200,'data' => [] ,'msg' => '修改成功'];
            }else{
                $response->data = ['code' => 400,'data' => [] ,'msg' => '修改失败'];
            }
        }
        return $response;
    }
}