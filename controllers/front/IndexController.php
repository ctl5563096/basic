<?php declare(strict_types=1);

namespace app\controllers\front;

use app\controllers\FrontController;
use app\service\ArticleService;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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
        $data = ArticleService::findAllArticle();
        return $this->render('index',['data' => $data]);
    }
}