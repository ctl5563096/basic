<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\service\MessageBoardService;
use Yii;
use yii\web\BadRequestHttpException;

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
        $params   = $this->request->post();
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
     * @throws BadRequestHttpException
     * @author chentulin
     */
    public function actionChangeRead()
    {
        $id  = $this->request->get('id');
        $res = $this->messageService->changeRead((int)$id);
        if ($res) {
            exit(json_encode([
                'code' => 200,
                'msg'  => '阅读成功',
            ]));
        } else {
            exit(json_encode([
                'code' => 400,
                'msg'  => '阅读失败',
            ]));
        }
    }

    /**
     * Notes: 删除留言
     * @throws BadRequestHttpException
     * @author: chentulin
     * Date: 2020/5/11
     * Time: 21:31
     */
    public function actionDelete()
    {
        $id  = $this->request->get('id');
        $res = $this->messageService->delete((int)$id);
        if ($res) {
            exit(json_encode([
                'code' => 200,
                'msg'  => '删除成功',
            ]));
        } else {
            exit(json_encode([
                'code' => 400,
                'msg'  => '删除失败',
            ]));
        }
    }

    /**
     * Notes: 回复接口
     * @author: chentulin
     * Date: 2020/5/11
     * Time: 22:33
     */
    public function actionReply()
    {
        $id      = $this->request->get('id');
        $content = $this->request->post('content');
        $res     = $this->messageService->reply((int)$id, (string)$content);
        if ($res) {
            exit(json_encode([
                'code'    => 200,
                'msg'     => '回复成功',
                'content' => $content
            ]));
        }
        exit(json_encode([
            'code'    => 400,
            'msg'     => '失败',
        ]));
    }
}