<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use yii\bootstrap\NavBar;
use yii\db\Query;
use yii\web\Controller;
use app\models\AdminUser;
use yii\web\Response;

/**
 * 登陆模块
 * Class LoginController
 * @package app\controllers\backend
 */
class LoginController extends Controller
{
    /**
     * Date: 2019/12/4
     * Author: ctl
     * @return string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->response;

        // 判断是提交参数还是渲染页面
        if ($request->isGet){
            return $this->render('login');
        }else{
            $response->format = Response::FORMAT_JSON;
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
            $row = (new Query())->select('*')->from('admin_user')->where('username = :username')->addParams([':username' => $username])->one();
            if (password_verify($password ,$row['password'])){
                $response->data = ['code' => 200 ,'msg' => '登陆成功'];
            }else{
                $response->data = ['code' => 500 ,'msg' => '密码错误'];
            }
        }
    }
}
