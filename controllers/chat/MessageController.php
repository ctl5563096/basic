<?php declare(strict_types=1);


namespace app\controllers\chat;

use yii\web\Controller;

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
}