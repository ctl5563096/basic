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
        $level = (int)$this->request->get('level');
        if ($this->request->isGet){
            // 根据菜单等级来判断加载的页面
            if ($level === 0){
                return $this->render('add_zero');
            }else{
                return $this->render('add_first');
            }
        }else{
            $this->response->format = \yii\web\Response::FORMAT_JSON;
            $level = $level??0;
            $name = $this->request->post('menu');
            $res = Menu::addMenu($level ,$name);
            if ($res === true){
                return $this->response->data = ['code' => 200 ,'msg' => '添加菜单成功'];
            }else{
                return $this->response->data = ['code' => 500 ,'msg' => '添加菜单失败'];
            }
        }
    }

    /**
     * 删除菜单
     * Date: 2019/12/18
     * @author chentulin
     */
    public function actionDelete()
    {
        $id = (int)$this->request->post('id');
        // 菜单删除需要把父菜单和子菜单全部删除
        $res = Menu::deletAllMenu($id);
        if ($res){
            $this->response->format = \yii\web\Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200 ,'msg' => '删除成功'];
        }
    }

    /**
     * 编辑一级菜单的子菜单
     * DATE : 2019/12/19 23:57
     * @author chentulin
     */
    public function actionEdit()
    {
        if (!$this->request->isAjax){
            $id = (int)$this->request->get('id');
            $name = $this->request->get('name');
            // 找出该菜单下面所有的子菜单

        }else{
            var_dump(22222222222);
        }
    }
}