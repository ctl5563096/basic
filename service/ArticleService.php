<?php declare(strict_types=1);

namespace app\service;

use app\dao\ArticleDao;
use app\dto\ArticleDto;
use Yii;
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
    public function updateService(ArticleDto $dto,int $id)
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
}
