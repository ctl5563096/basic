<?php declare(strict_types=1);

namespace app\controllers\front;

use app\apiService\weatherApiService;
use app\controllers\FrontController;
use app\service\ArticleService;
use app\service\CommentService;
use app\service\MessageBoardService;
use Yii;
use yii\web\Response;

class IndexController extends FrontController
{
    /**
     * 博客前台主页
     *
     * Date: 2020/5/6
     * @author chentulin
     */
    public function actionIndex()
    {
        $api = new weatherApiService();
        // 调用天气服务层
        $moreWeather = $api->getReportWeatherByIp();
        // 天气服务
        $weather = $api->getTodayWeatherByIp();
        // 文章列表
        $indexData = ArticleService::findAllArticle();
        // 获取热点文章
        $hotArticle = ArticleService::findHotArticle();
        // 获取最新三条留言
        $Comment = MessageBoardService::findHotMessage();
        return $this->render('index', ['data' => $indexData, 'hotArticle' => $hotArticle, 'comment' => $Comment, 'weather' => current($weather['results']) ,'moreWeather' => current($moreWeather['results'])]);
    }

    /**
     * 我的个人介绍界面
     *
     * Date: 2020/5/7
     * @author chentulin
     */
    public function actionBlog()
    {
        return $this->render('personal');
    }

    /**
     * 点赞接口
     *
     * Date: 2020/5/7
     * @author chentulin
     */
    public function actionLike()
    {
        $id      = Yii::$app->request->post('id');
        $service = new ArticleService();
        $res     = $service->addLike((int)$id);
        if ($res) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '成功'];
        }
    }

    /**
     * 点赞接口
     *
     * Date: 2020/5/7
     * @author chentulin
     */
    public function actionHate()
    {
        $id      = Yii::$app->request->post('id');
        $service = new ArticleService();
        $res     = $service->addHate((int)$id);
        if ($res) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '成功'];
        }
    }

    /**
     * 查看文章详情
     *
     * Date: 2020/5/7
     * @author chentulin
     */
    public function actionDetail()
    {
        $id      = Yii::$app->request->get('id');
        $service = new ArticleService();
        $detail  = $service->detailService((int)$id);
        $service->addLook((int)$id);
        // 获取评论详情
        $comment_detail = (new CommentService)->getList((int)$id);
        return $this->render('detail', array('detail' => $detail, 'comment' => $comment_detail));
    }

    /**
     * 获取文章列表 搜索文章
     *
     * Date: 2020/5/8
     * @author chentulin
     */
    public function actionArticleList()
    {
        $params   = $this->request->get();
        $dataList = (new ArticleService())->getList($params);
        // 判断总页数
        if ($dataList['totalPage'] === 1) {
            $params['page'] = 1;
        }
        return $this->render('page', ['data' => $dataList['dataList'], 'page' => $params['page'] ?? 1, 'totalPage' => $dataList['totalPage'], 'params' => $params, 'totalCount' => $dataList['totalCount']]);
    }

    /**
     * Notes: 获取近今天 明天 后天天气预报
     * @author: chentulin
     * Date: 2020/5/10
     * Time: 11:50
     */
    public function actionGetWeatherReport()
    {
        $api = new weatherApiService();
        // 调用天气服务层
        $res = $api->getReportWeatherByIp();
        $this->response->format = Response::FORMAT_JSON;
        return $this->response->data = ['code' => 200, 'msg' => '成功', 'dataList' => current($res['results']) ];
    }
}