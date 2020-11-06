<?php declare(strict_types=1);


namespace app\controllers\chat;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\service\WeChatService;

/**
 * 客服聊天控制器
 *
 * Class MessageController
 * @package app\controllers\chat
 */
class MessageController extends Controller
{
    /**
     * @var bool 关闭yii2自带布局
     */
    public $layout = false;

    /**
     * 渲染聊天页面
     *
     * Date: 2020/6/19
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
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
        if (!$openid || !$customId || !$content){
            $response->data = ['code' => '400' , 'msg' => '缺少参数'];
        }else{
            // 获取发送内容
            $weChatServiceRes = WeChatService::sendMessage($openid,(int)$customId,$content);
                if ($weChatServiceRes){
                    $response->data = ['code' => '200' , 'msg' => '发送成功'];
                }else{
                    $response->data = ['code' => '400' , 'msg' => '发送失败'];
            }
        }
        return $response;
    }
}