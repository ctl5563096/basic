<?php declare(strict_types=1);


namespace app\service;


use app\dao\CommentDao;
use app\dto\CommentDto;
use yii\web\Response;

/**
 * Class CommentService
 * @package app\service
 * @property CommentDao $commentDao
 */
class CommentService extends BaseService
{
    /** @var CommentDao $commentDao */
    public $commentDao;

    /** @var Response $response */
    public $response;

    public function __construct()
    {
        parent::__construct();
        $this->commentDao = new CommentDao();
    }

    /**
     * 获取文章下面的评论
     *
     * Date: 2020/5/7
     * @param int $id
     * @return array
     * @author chentulin
     */
    public function getList(int $id): array
    {
        return $this->commentDao::find()->select('*')->where(['article_id' => $id])->andWhere(['is_delete' => 0])->orderBy(['created_at' => SORT_DESC])->asArray()->all();
    }

    /**
     * 新建记录
     *
     * Date: 2020/5/7
     * @param CommentDto $dto
     * @return array
     * @author chentulin
     */
    public function createRecord(CommentDto $dto)
    {
        $params               = $dto->getAttributes();
        $params['created_at'] = time();
        $params['user_id']    = 0;
        $params['user_name']  = '游客' . time();
        $dao = new CommentDao();
        $dao->setAttributes($params);
        $res = $dao->save();
        if ($res){
            return $dao->getAttributes();
        }

        $this->response->format = Response::FORMAT_JSON;
        return $this->response->data = ['code' => 400, 'msg' => current($dao->getFirstErrors())];
    }

    /**
     * 后台获取文章评论列表
     *
     * Date: 2020/5/12
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function getAllList(array $params): array
    {
        return $this->commentDao->findAllByParams($params);
    }

    /**
     * 删除评论
     *
     * Date: 2020/5/12
     * @param int $id
     * @return bool
     * @author chentulin
     */
    public function delete(int $id): bool
    {
        return $this->commentDao->deleteComment($id);
    }
}