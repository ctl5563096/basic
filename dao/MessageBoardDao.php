<?php declare(strict_types=1);


namespace app\dao;

use app\models\MessageBoard;
use yii\data\ActiveDataProvider;
use yii\db\Query;

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
    public function createRecord(array $params,array $dto): bool
    {
        $dao = new self();
        $dao->setAttributes($dto);
        $dao->content = $params['content'];
        $dao->name = $params['name'];
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
                'pageSize' => 15,
            ],
        ]);

        return [
            'dataList'   => $provider->getModels(),
            'totalPage'  => (int)ceil($provider->totalCount / 15),
        ];
    }
}