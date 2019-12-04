<?php declare(strict_types=1);

namespace app\controllers\backend;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;

/**
 * 注册模块
 * Class RegisterController
 * @package app\controllers\backend
 */
class RegisterController extends Controller
{
    /**
     * 渲染视图&&注册
     * Date: 2019/12/4
     * Author: ctl
     */
    public function actionRegister()
    {
        $request = Yii::$app->request;
        if ($request->isGet){
            return $this->render('register');
        }else{

        }
    }
}