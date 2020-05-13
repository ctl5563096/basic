<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\service\AccessRecordService;
use app\service\ArticleService;
use app\service\MessageBoardService;

/**
 * 数据统计模块
 *
 * Class DataCountController
 * @package app\controllers\backend
 * @property AccessRecordService $accessService 访问服务层
 * @property ArticleService $articleService 文章服务层
 * @property MessageBoardService $messageService 留言板服务层
 */
class DataCountController extends BaseController
{
    /** @var AccessRecordService $accessService */
    public $accessService;

    /** @var ArticleService $articleService */
    public $articleService;

    /** @var MessageBoardService $messageService */
    public $messageService;

    /**
     * DataCountController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->messageService = new MessageBoardService();
        $this->accessService  = new AccessRecordService();
        $this->articleService = new ArticleService();
    }

    /**
     * 统计页面首页,每日统计
     *
     * Date: 2020/5/12
     * @author chentulin
     */
    public function actionIndex()
    {
        $date = $this->request->get('time');
        if (!isset($date)) {
            $date = mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y'));
        } else {
            $dateArr = explode('-', $date);
            $date    = mktime(0, 0, 0, (int)date($dateArr[1]), (int)date($dateArr[2]), (int)date($dateArr[0]));
        }
        $messageData  = $this->messageService->getDataCount('day', $date);
        $articleData  = $this->articleService->getDataCount('day', $date);
        $accessData   = $this->accessService->getDataCount('day', $date);
        $messageTotal = array_sum($messageData);
        $articleTotal = array_sum($articleData);
        $accessTotal  = array_sum($accessData);
        $messageData  = implode(',', $messageData);
        $articleData  = implode(',', $articleData);
        $accessData   = implode(',', $accessData);
        return $this->render('index', array('messageData' => $messageData, 'messageTotal' => $messageTotal, 'articleData' => $articleData, 'articleTotal' => $articleTotal, 'accessTotal' => $accessTotal, 'accessData' => $accessData));
    }

    /**
     * 统计页面首页,每周统计
     *
     * Date: 2020/5/12
     * @author chentulin
     */
    public function actionWeek()
    {
        $date         = mktime(0, 0, 0, (int)date('m'), (int)date('d') - date('w') + 1, (int)date('Y'));
        $messageData  = $this->messageService->getDataCount('week', $date);
        $articleData  = $this->articleService->getDataCount('week', $date);
        $accessData   = $this->accessService->getDataCount('week', $date);
        $messageTotal = array_sum($messageData);
        $messageData  = implode(',', $messageData);
        $articleTotal = array_sum($articleData);
        $articleData  = implode(',', $articleData);
        $accessTotal  = array_sum($accessData);
        $accessData   = implode(',', $accessData);
        return $this->render('week',
            [
                'messageData'  => $messageData,
                'messageTotal' => $messageTotal,
                'articleData'  => $articleData,
                'articleTotal' => $articleTotal,
                'accessTotal'  => $accessTotal,
                'accessData'   => $accessData
            ]
        );
    }

    /**
     * 统计页面首页,每月统计
     *
     * Date: 2020/5/12
     * @author chentulin
     */
    public function actionMonth()
    {
        $date         = mktime(0, 0, 0, (int)date('m'), 1, (int)date('Y'));
        $messageData  = $this->messageService->getDataCount('month', $date);
        $articleData  = $this->articleService->getDataCount('month', $date);
        $accessData   = $this->accessService->getDataCount('month', $date);
        $messageTotal = array_sum($messageData);
        $messageData  = implode(',', $messageData);
        $articleTotal = array_sum($articleData);
        $articleData  = implode(',', $articleData);
        $accessTotal  = array_sum($accessData);
        $accessData   = implode(',', $accessData);
        return $this->render('month',
            [
                'messageData'  => $messageData,
                'messageTotal' => $messageTotal,
                'articleData'  => $articleData,
                'articleTotal' => $articleTotal,
                'accessTotal'  => $accessTotal,
                'accessData'   => $accessData
            ]
        );
    }
}