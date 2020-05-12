<?php declare(strict_types=1);


namespace app\dao;

use app\models\MessageBoard;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\BadRequestHttpException;

/**
 * 留言板数据访问层
 *
 * Class MessageBoardDao
 * @package app\dao
 */
class MessageBoardDao extends MessageBoard
{
    /**
     * 新增记录
     *
     * Notes:
     * @param array $params
     * @param array $dto
     * @return bool
     * @author: chentulin
     * Date: 2020/5/8
     * Time: 21:46
     */
    public function createRecord(array $params, array $dto): bool
    {
        $dao = new self();
        $dao->setAttributes($dto);
        $dao->content    = $params['content'];
        $dao->name       = $params['name'];
        $dao->created_at = time();
        return $dao->save();
    }

    /**
     * Notes: 获取留言板数据
     * @author: chentulin
     * Date: 2020/5/11
     * Time: 0:25
     */
    public static function getDataList()
    {
        $query = new Query();
        $query->from(self::tableName());
        $query->select('*');
        $query->where(['is_delete' => 0]);
        $query->orderBy(['created_at' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return [
            'dataList'  => $provider->getModels(),
            'totalPage' => (int)ceil($provider->totalCount / 10),
        ];
    }

    /**
     * 后台获取留言内容
     *
     * Date: 2020/5/11
     * @param array $params
     * @return array
     * @author chentulin
     */
    public static function getListBackend(array $params): array
    {
        $query = new Query();
        $query->from(self::tableName());
        $query->where(['is_delete' => 0]);
        $query->andFilterWhere(['is_read' => $params['is_read'] ?? null]);
        $query->andFilterWhere(['is_reply' => $params['is_reply'] ?? null]);
        $query->andFilterWhere(['like' , 'name', $params['name'] ?? null]);
        $query->orderBy(['created_at' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => $params['pageSize'],
                'page'     => $params['page'] - 1,
            ],
        ]);

        return [
            'dataList'   => $provider->getModels(),
            'totalCount' => $provider->totalCount,
        ];
    }

    /**
     * 改变已读状态
     *
     * Date: 2020/5/11
     * @param int $id
     * @return bool
     * @throws BadRequestHttpException
     * @author chentulin
     */
    public function changeRead(int $id): bool
    {
        $dao = self::findOne(['id' => $id]);
        if (!$dao) {
            throw new BadRequestHttpException('没有找到资源');
        }
        $dao->is_read = 1;
        return $dao->save();
    }

    /**
     * Notes: 删除
     * @param int $id
     * @return bool
     * @throws BadRequestHttpException
     * @author: chentulin
     * Date: 2020/5/11
     * Time: 21:33
     */
    public function changeDelete(int $id)
    {
        $dao = self::findOne(['id' => $id]);
        if (!$dao) {
            throw new BadRequestHttpException('没有找到资源');
        }
        $dao->is_delete = 1;
        return $dao->save();
    }

    /**
     * 获取每日统计数量留言
     *
     * Date: 2020/5/12
     * @param int $date
     * @return array
     * @author chentulin
     */
    public function getDayCount(int $date): array
    {
        $count = [];
        $timeRes = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($timeRes as $key => $value){
            $num = $key + 1;
            $beginTime = $key * 3600 + $date;
            $endTime = ($num * 3600 +  $date) - 1;
            $data = (new Query())
                ->from(self::tableName())
                ->select(['created_at'])
                ->where(['between' ,'created_at' ,$beginTime ,$endTime])
                ->count();
            $count[$key] = (int)$data;
        }
        return $count;
    }

    /**
     * Notes: 获取每周留言板统计
     * @param int $date
     * @return array
     * @author: chentulin
     * Date: 2020/5/13
     * Time: 1:13
     */
    public function getWeekCount(int $date): array
    {
        return [];
    }

    /**
     * Notes: 获取每月统计
     * @param int $date
     * @return array
     * @author: chentulin
     * Date: 2020/5/13
     * Time: 1:14
     */
    public function getMonthCount(int $date): array
    {
        return [];
    }
}