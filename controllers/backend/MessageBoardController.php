<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\service\MessageBoardService;
use Yii;

/**
 * 留言板管理模块
 *
 * Class MessageBoardController
 * @package app\controllers\backend
 * @property string $user
 * @property MessageBoardService $messageService
 */
class MessageBoardController extends BaseController
{
    /** @var string $user */
    public $user;

    /** @var MessageBoardService $messageService */
    public $messageService;

    /**
     * MessageBoardController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->user           = Yii::$app->session->get('user');
        $this->messageService = new MessageBoardService();
    }

    /**
     * 前端渲染页面
     *
     * Date: 2020/5/11
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 获取列表
     *
     * Date: 2020/5/11
     * @author chentulin
     */
    public function actionList()
    {
        $params = $this->request->post();
        $dataList = $this->messageService->getListBackend($params);
        exit(json_encode([
            'code' => 200,
            'msg'  => '获取列表成功',
            'list' => $dataList
        ]));
    }

    /**
     * 改变已读状态
     *
     * Date: 2020/5/11
     * @author chentulin
     */
    public function actionChangeRead()
    {
        $id = $this->request->get('id');
        $res = $this->messageService->changeRead((int)$id);
        exit(json_encode([
            'code' => 200,
            'msg'  => '阅读成功',
        ]));
    }
}