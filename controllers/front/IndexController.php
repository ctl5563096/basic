<?php declare(strict_types=1);

namespace app\controllers\front;

use app\controllers\FrontController;
use app\service\ArticleService;
use app\service\CommentService;
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
        // 文章列表
        $indexData = ArticleService::findAllArticle();
        // 获取热点文章
        $hotArticle = ArticleService::findHotArticle();
        return $this->render('index',['data' => $indexData,'hotArticle' => $hotArticle]);
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
        $id = Yii::$app->request->post('id');
        $service = new ArticleService();
        $res = $service->addLike((int)$id);
        if ($res){
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
        $id = Yii::$app->request->post('id');
        $service = new ArticleService();
        $res = $service->addHate((int)$id);
        if ($res){
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
        $id = Yii::$app->request->get('id');
        $service = new ArticleService();
        $detail = $service->detailService((int)$id);
        $service->addLook((int)$id);
        // 获取评论详情
        $comment_detail = (new CommentService)->getList((int)$id);
        return $this->render('detail',array('detail' => $detail,'comment' => $comment_detail));
    }
}