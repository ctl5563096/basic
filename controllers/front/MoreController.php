<?php declare(strict_types=1);


namespace app\controllers\front;


use app\controllers\FrontController;

/**
 * 查看更多控制器
 *
 * Class MoreController
 * @package app\controllers\front
 */
class MoreController extends FrontController
{
    /**
     * 查看更多视图
     *
     * Date: 2020/5/19
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Notes: 新页面首页
     *
     * @author: chentulin
     * Date: 2021/1/3
     * Time: 23:18
     */
    public function actionNewIndex()
    {
        return $this->render('page');
    }
}