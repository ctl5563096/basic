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
        if (!isset($date)){
            $date = mktime(0,0,0,(int)date('m'),(int)date('d'),(int)date('Y'));
        }else{
            $dateArr = explode('-',$date);
            $date = mktime(0,0,0,(int)date($dateArr[1]),(int)date($dateArr[2]),(int)date($dateArr[0]));
        }
        $this->messageService->getDataCount('day',$date);
        return $this->render('index');
    }

    /**
     * 统计页面首页,每周统计
     *
     * Date: 2020/5/12
     * @author chentulin
     */
    public function actionWeek()
    {
        return $this->render('week');
    }

    /**
     * 统计页面首页,每月统计
     *
     * Date: 2020/5/12
     * @author chentulin
     */
    public function actionMonth()
    {
        return $this->render('4month');
    }
}