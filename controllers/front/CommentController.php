<?php declare(strict_types=1);


namespace app\controllers\front;

use app\controllers\FrontController;
use app\dto\CommentDto;
use app\service\CommentService;
use Yii;
use yii\web\Response;

/**
 * 评论控制器
 *
 * Class CommentController
 * @package app\controllers\front
 */
class CommentController extends FrontController
{
    /**
     * 评论文章
     *
     * Date: 2020/5/7
     * @author chentulin
     */
    public function actionComment()
    {
        $params = $this->request->post();
        $params['article_id'] = (int)$params['article_id'];
        $params['ip'] = (string)Yii::$app->request->userIP;
        $dto = new CommentDto();
        $dto->setAttributes($params);
        $dto->validate();
        $res = (new CommentService())->createRecord($dto);
        $res['created_at'] =  date('Y-m-d H:i:s', $res['created_at']);
        if ($res){
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '插入成功' , 'data' => $res];
        }
    }
}