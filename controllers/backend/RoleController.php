<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use app\commands\BaseController;
use app\models\Role;
use yii\web\Response;
use Yunpian\Sdk\YunpianClient;

/**
 * 角色模块
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

    /**
     * 删除角色
     * Date: 2019/12/13
     * @author chentulin
     */
    public function actionDelete()
    {
        $id = $this->request->post('id');
        $this->response->format = \yii\web\Response::FORMAT_JSON;
        if ($id){
            $res = Role::deleteAll('id = :id' ,[':id' => $id]);
        }else{
            $this->response->data = ['msg' => '删除失败,角色不存在' , 'code' => 500];
        }
        if ($res){
            $this->response->data = ['msg' => '删除成功' , 'code' => 200];
        }else{
            $this->response->data = ['msg' => '删除失败,请联系管理员' , 'code' => 500];
        }
    }

    public function actionTest()
    {
        $clnt = YunpianClient::create('177a2833184609c6fae709150d709409');
        $param = [YunpianClient::MOBILE => '13692477981',YunpianClient::TEXT => '【云片网】您的验证码是1234'];
        $r = $clnt->sms()->single_send($param);
        if($r->isSucc()){
            var_dump($r->data());
        }
    }
}
