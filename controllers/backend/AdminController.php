<?php declare(strict_types=1);

namespace app\controllers\backend;

use app\commands\BaseController;

/**
 * 后台主页
 * Class AdminController
 * @package app\controllers\backend
 */
class AdminController extends BaseController
{
    /**
     * 菜单展示
     * Date: 2019/12/11
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 测试模块
     * Date: 2019/12/12
     * @author chentulin
     */
    public function actionTest()
    {
        return $this->render('test');
    }
}