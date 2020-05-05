<?php declare(strict_types=1);


namespace app\dao;

use app\dto\ArticleDto;
use app\models\AdminUser;
use app\models\Article;
use Yii;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\BadRequestHttpException;

/**
 * 文章数据访问层
 *
 * Class ArticleDao
 * @package app\dao
 *
 * @property array $allArticle
 * @property array $list
 */
class ArticleDao extends Article
{
    /**
     * 获取文章数据
     *
     * Date: 2020/3/27
     * @param int $id
     * @param array $params
     * @return array
     * @throws BadRequestHttpException
     * @author chentulin
     */
    public function getList(int $id, array $params): array
    {
        // 根据id判断是否有全部阅读全部文章权限没有管理员的权限
        $userModel = AdminUser::findOne(['id' => $id]);
        if (!$userModel) {
            throw new BadRequestHttpException('没有找到资源');
        }
        if ($userModel->role_id === 4) {
            return $this->getAllArticle($params);
        }
        $query    = self::find()->select('*')->where(['is_delete' => 'no'])->andWhere(['author' => $id]);
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
     * 获取所有用户的文章
     *
     * Date: 2020/3/27
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function getAllArticle(array $params): array
    {
        // 数据提供器
        $query    = self::find()->select('*')->where(['is_delete' => 'no']);
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
     * 新增文章
     *
     * Date: 2020/5/5
     * @param ArticleDto $dto
     * @return bool
     * @author chentulin
     */
    public function create(ArticleDto $dto): bool
    {
        $this->setAttributes($dto->getAttributes());
        $this->author     = (int)Yii::$app->session->get('user_id');
        $this->created_at = time();
        return $this->save();
    }
}