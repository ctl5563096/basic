<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use app\commands\BaseController;
use app\models\Role;
use yii\web\Response;

/**
 * 权限模块
 * Class RoleController
 * @package app\controllers\backend
 */
class RoleController extends BaseController
{
    /**
     * 角色列表展示
     * DATE : 2019/12/12 23:29
     * @author chentulin
     */
    public function actionIndex()
    {
        $list = Role::findRoleAll();
        return $this->render('index' ,array('list' =>$list));
    }

    /**
     * 添加角色
     * DATE : 2019/12/13 0:06
     * @author chentulin
     */
    public function actionAdd()
    {
        $request = Yii::$app->request;
        // 判断是Ajax提交 还是渲染页面
        if ($request->isAjax){
            $roleName = $request->post('role_name');
            $res = Role::addRole($roleName);
            if ($res){
                $this->response->format = Response::FORMAT_JSON;
                $this->response->data = ['msg' => '添加成功' , 'code' => 200];
            }
        }else{
            return $this->render('add' );
        }
    }
}