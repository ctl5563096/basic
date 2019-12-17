<?php declare(strict_types=1);

namespace app\controllers\backend;

use app\commands\BaseController;
use app\models\Menu;

/**
 * 菜单模块
 * Class MenuController
 * @package app\controllers\backend
 */
class MenuController extends BaseController
{
    public $zero = 0;
    public $first = 1;

    /**
     * 展示一级菜单
     * DATE : 2019/12/17 20:20
     * @author chentulin
     */
    public function actionIndex()
    {
        $lists = Menu::findAllMenu($this->zero);
        return $this->render('index' ,array('lists' => $lists));
    }

    /**
     * 增加菜单
     * DATE : 2019/12/17 20:39
     * @author chentulin
     */
    public function actionAdd()
    {
        var_dump($this->request->get());
        die();
    }
}