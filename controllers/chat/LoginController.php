<?php declare(strict_types=1);

namespace app\controllers\chat;

use app\components\Redis;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Response;

/**
 * 客服登录页面
 *
 * Class LoginController
 * @package app\controllers\chat
 */
class LoginController extends Controller
{
    public $layout = false;
    /**
     * 修改默认访问的方法
     * @var string
     */
    public $defaultAction = 'custom';

    /**
     * 客服登录页面
     *
     * Date: 2020/6/18
     * @author chentulin
     */
    public function actionCustom()
    {
        $request  = Yii::$app->request;
        $response = Yii::$app->response;

        // 判断是提交参数还是渲染页面
        if ($request->isGet) {
            return $this->render('login');
        } else {
            $response->format = Response::FORMAT_JSON;
            $username         = Yii::$app->request->post('username');
            $password         = Yii::$app->request->post('password');
            $row              = (new Query())->select('*')->from('admin_user')->where('username = :username')->addParams([':username' => $username])->one();
            if (password_verify($password, $row['password'])) {
                $redis = Redis::getInstance(1,Yii::$app->params['redis']['password'])->getRedis();
                $redis->zAdd('custom',[],0,$row['id']);
                $response->data = ['code' => 200, 'msg' => '登陆成功'];
            } else {
                $response->data = ['code' => 500, 'msg' => '密码错误'];
            }
        }
    }

    /**
     * Date: 2020/4/11
     * @author chentulin
     */
    public function actionLogout()
    {
        $this->redirect('custom');
    }
}