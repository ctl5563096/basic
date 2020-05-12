<?php declare(strict_types=1);


namespace app\dao;


use app\models\Comment;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\BadRequestHttpException;

/**
 * 文章评论数据访问层
 *
 * Class CommentDao
 * @package app\dao
 */
class CommentDao extends Comment
{
    /**
     * 后台文章列表数据提供器
     *
     * Date: 2020/5/12
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function findAllByParams(array $params): array
    {
        $query = self::find();
        $query->alias('a');
        $query->select(['a.*','b.article_name']);
        $query->leftJoin('article as b','a.article_id = b.id');
        $query->where(['a.is_delete' => 0]);

        $provider = new ActiveDataProvider([
            'query'      => $query->asArray(),
            'pagination' => [
                'pageSize' => $params['pageSize'],
                'page'     => $params['page']-1,
            ],
        ]);

        return [
            'dataList'   => $provider->getModels(),
            'totalCount' => $provider->totalCount,
        ];
    }

    /**
     * 删除评论
     *
     * Date: 2020/5/12
     * @param int $id
     * @return bool
     * @throws BadRequestHttpException
     * @author chentulin
     */
    public function deleteComment(int $id): bool
    {
        $dao = self::findOne(['id' => $id]);
        if (!$dao) {
            throw new BadRequestHttpException('没有找到资源');
        }
        $dao->is_delete = 1;
        return $dao->save();
    }
}