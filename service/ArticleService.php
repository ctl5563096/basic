<?php declare(strict_types=1);

namespace app\service;

use app\dao\ArticleDao;
use app\dto\ArticleDto;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Response;

/**
 * 文章服务层
 *
 * Class ArticleService
 * @package app\service
 * @property ArticleDao $articleDao
 */
class ArticleService extends BaseService
{
    public $articleDao;

    public $response;

    public function __construct()
    {
        parent::__construct();
        $this->articleDao = new ArticleDao();
    }

    /**
     * 改变订单状态
     *
     * Date: 2020/5/5
     * @param int $id
     * @return array|bool
     * @author chentulin
     */
    public function changeStatusService(int $id)
    {
        $dao = $this->articleDao::find()->where(['id' => $id])->one();
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '修改失败'];
        }
        if ($dao->is_display === 'yes') {
            $dao->is_display = 'no';
        } else {
            $dao->is_display = 'yes';
        }
        return $dao->save();
    }

    /**
     * 删除文章
     *
     * Date: 2020/5/5
     * @param int $id
     * @return array|bool
     *
     * @author chentulin
     */
    public function delete(int $id)
    {
        $dao = $this->articleDao::find()->where(['id' => $id])->one();
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        $dao->is_delete  = 'yes';
        $dao->deleted_at = time();
        return $dao->save();
    }

    /**
     * 查看文章内容详情
     *
     * Date: 2020/5/5
     * @param int $id
     * @return
     * @author chentulin
     */
    public function contentService(int $id)
    {
        $dao = $this->articleDao::find()->where(['id' => $id])->one();
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        return $dao->content;
    }

    /**
     * 返回文章详情
     *
     * Date: 2020/5/5
     * @param int $id
     * @return ArticleDao|array|\yii\db\ActiveRecord|null
     * @author chentulin
     */
    public function detailService(int $id)
    {
        $dao = $this->articleDao::find()->where(['id' => $id])->one();
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }

        return $dao;
    }

    /**
     * 更新服务层
     *
     * Date: 2020/5/5
     * @param ArticleDto $dto
     * @param int $id
     * @return array|bool
     * @author chentulin
     */
    public function updateService(ArticleDto $dto, int $id)
    {
        $dao = $this->articleDao::find()->where(['id' => $id])->one();
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        $dao->setAttributes($dto->getAttributes());
        return $dao->save();
    }

    /**
     * 获取所有文章
     *
     * Date: 2020/5/6
     * @author chentulin
     */
    public static function findAllArticle(): array
    {
        $dataList = ArticleDao::find()->select('*')->where(['is_display' => 'yes'])->andWhere(['is_delete' => 'no'])->limit(6)->asArray()->all();
        return $dataList;
    }

    /**
     * 获取前8名点赞数最多文章
     *
     * Date: 2020/5/7
     * @return array
     * @author chentulin
     */
    public static function findHotArticle(): array
    {
        $dataList = ArticleDao::find()->select(['id', 'author_nickname', 'article_name', 'like'])->where(['is_display' => 'yes'])->andWhere(['is_delete' => 'no'])->orderBy(['like' => SORT_DESC])->limit(7)->asArray()->all();
        return $dataList;
    }

    /**
     * 点赞
     *
     * Date: 2020/5/7
     * @param int $id
     * @return bool|array
     * @author chentulin
     */
    public function addLike(int $id)
    {
        $dao = $this->articleDao::findOne(['id' => $id]);
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        ++$dao->like;
        return $dao->save();
    }

    /**
     * 踩
     *
     * Date: 2020/5/7
     * @param int $id
     * @return bool|array
     * @author chentulin
     */
    public function addHate(int $id)
    {
        $dao = $this->articleDao::findOne(['id' => $id]);
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        ++$dao->hate;
        return $dao->save();
    }

    /**
     * Notes:
     * @param int $id
     * @return array|bool
     * @author: chentulin
     * Date: 2020/5/7
     * Time: 19:52
     */
    public function addLook(int $id)
    {
        $dao = $this->articleDao::findOne(['id' => $id]);
        if (!$dao) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 400, 'msg' => '无法找到资源'];
        }
        ++$dao->see_num;
        return $dao->save();
    }

    /**
     * 文章列表服务层
     *
     * Date: 2020/5/8
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function getList(array $params): array
    {
        $query = new Query();
        $query->from(ArticleDao::tableName());
        $query->select('*');
        $query->where(['is_delete' => 'no']);
        $query->andWhere(['is_display' => 'yes']);
        $query->andFilterWhere(['module' => $params['module'] ?? null]);
        $query->andFilterWhere(['like', 'article_name', $params['article_name'] ?? null]);
        $query->orderBy(['created_at' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return [
            'dataList'   => $provider->getModels(),
            'pageParams' => $provider->getPagination(),
            'totalPage'  => (int)ceil($provider->totalCount / 5),
            'totalCount' => $provider->totalCount
        ];
    }

    /**
     * 获取每日文章情况
     *
     * Date: 2020/5/12
     * @param string $type
     * @param int $date
     * @return array
     * @author chentulin
     */
    public function getDataCount(string $type,int $date): array
    {
        switch ($type){
            case 'day':
                return $this->articleDao->getDayCount($date);
            case 'week':
                return $this->articleDao->getWeekCount($date);
            case 'month':
                return $this->articleDao->getMonthCount($date);
        }
        return [];
    }
}
