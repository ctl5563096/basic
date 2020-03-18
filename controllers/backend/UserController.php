<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\models\AdminUser;
use app\dao\UserDao;

/**
 * 用户模块
 *
 * Class UserController
 * @package app\controllers\backend
 * @property AdminUser $userModel
 * @property UserDao $userDao
 */
class UserController extends BaseController
{
    /**
     * @var AdminUser
     */
    public $userModel;

    /**
     * @var UserDao
     */
    public $userDao;

    /**
     * 构造函数
     *
     * UserController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userModel = new AdminUser();
        $this->userDao   = new UserDao();
    }

    /**
     * 用户页面展示
     *
     * Date: 2020/3/16
     * @author chentulin
     */
    public function actionIndex()
    {
        // 判断是否为ajax请求
        if ($this->request->isAjax) {
            $dataList = $this->userDao->getList($this->request->post());
            exit(json_encode([
                'code' => 200,
                'msg'  => '获取列表成功',
                'list' => $dataList
            ]));
        }
        return $this->render('index', ['lists' => []]);
    }

    /**
     * 改变用户启用状态
     *
     * Date: 2020/3/18
     * @param int $id
     * @author chentulin
     */
    public function actionChangeStatus(int $id)
    {
        $this->userDao->changeStatus($id);
        exit(json_encode([
            'code' => 200,
            'msg'  => '修改用户状态成功',
        ]));
    }
}