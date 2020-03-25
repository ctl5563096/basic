<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\components\mq\RabbitMq;
use app\dao\ArticleDao;
use app\models\Article;

/**
 * 文章管理
 *
 * Class ActicleController
 * @package app\controllers\backend
 * @property integer $userId
 * @property ArticleDao $articleDao
 */
class ArticleController extends BaseController
{
    /**
     * @var integer 用户id
     */
    public $userId;

    /**
     * @var ArticleDao
     */
    public $articleDao;

    /**
     * 获取文章列表
     *
     * Date: 2020/3/19
     * @throws \Exception
     * @author chentulin
     */
    public function actionIndex()
    {
        $client = new RabbitMq('guest','guest','127.0.0.1',5672);
        $client->sendMessage(json_encode(['test' => 111111111]));
    }
}