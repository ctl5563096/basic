<?php declare(strict_types=1);


namespace app\controllers\chat;


use Yii;
use yii\web\Controller;

/**
 * 聊天客户端基类
 *
 * Class BaseChatController
 * @package app\controllers\chat
 */
class BaseChatController extends Controller
{
    public function  __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        // 如果没有customId 则重定向到登录页面
        if (!Yii::$app->session->get('customId')){
            $this->redirect('custom');
        }
    }
}