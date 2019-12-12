<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;
use yii\web\Response;

/**
 * 注册模块
 * Class RegisterController
 * @package app\controllers\backend
 */
class RegisterController extends Controller
{
    /**
     * 渲染视图或者是注册接口
     * Date: 2019/12/11
     * @return string | array
     *@author chentulin
     */
    public function actionRegister()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        if ($request->isGet){
            return $this->render('register');
        }else{
            try{
                $response->format = \yii\web\Response::FORMAT_JSON;
                $model = new AdminUser();
                $data = $request->post();
                // 确认密码
                if ((int)$data['password'] !== (int)$data['enter_password']){
                    return $response->data = ['msg' => '两次密码不一致' , 'code' => 500];

                }
                $model->username = $data['username'];
                $model->password = password_hash($data['password'] ,PASSWORD_DEFAULT);
                $model->phonenumber = (int)$data['phone'];
                $res = $model->save();
                if ($res){
                    $response->data = ['msg' => '注册成功' , 'code' => 200];
                }
            }catch (\Exception $e){
                $msg = $e->getMessage();
                if (strpos($e->getMessage(), 'Duplicate entry')){
                    $msg = '用户名或者手机已经被注册';
                }
                $response->data = ['msg' => $msg, 'code' => 500];
            }
        }
    }
}