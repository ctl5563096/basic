<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;

class LoginController extends Controller
{
   public $enableCsrfValidation = false;

    /**
     * 登陆模块
     * Date: 2019/12/4
     * Author: ctl
     * @return string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;

        // 判断是提交参数还是渲染页面
        if ($request->isGet){
            return $this->render('login');
        }else{
	    var_dump(1111111111111);
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
        }
    }
}
