<?php declare(strict_types=1);


namespace app\controllers\front;


use app\controllers\FrontController;
use app\dto\MessageBoardDto;
use app\service\MailService;
use app\service\MessageBoardService;
use yii\web\Response;

/**
 * 留言板控制器以及消息处理器
 *
 * Class MessageController
 * @package app\controllers\front
 * @property MessageBoardService $messageBoardService
 */
class MessageController extends FrontController
{
    /** @var MessageBoardService $messageBoardService */
    public $messageBoardService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->messageBoardService = new MessageBoardService();
    }

    /**
     * 留言板功能
     *
     * Notes:
     * @author: chentulin
     * Date: 2020/5/8
     * Time: 21:32
     */
    public function actionMessageBoard()
    {
        $params = $this->request->post();
        $dto    = new MessageBoardDto();
        $dto->setAttributes($params);
        $dto->validate();
        $res = $this->messageBoardService->createRecord($params,$dto->getAttributes());
        if ($res) {
            // 这里需要用异步处理 否则会阻塞留言接口
            $mailService = new MailService();
            $mailService->sendMail($params['content']);
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '成功'];
        }
    }
}