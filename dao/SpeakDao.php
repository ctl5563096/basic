<?php declare(strict_types=1);


namespace app\dao;


use app\models\Speak;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * 数据提供层
 *
 * Class SpeakDao
 * @package app\dao
 */
class SpeakDao extends Speak
{
    /**
     * 数据和提供层获取列表
     *
     * Date: 2020/5/18
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function getList(array $params): array
    {
        $query = self::find();

        $provider = new ActiveDataProvider([
            'query'      => $query->asArray(),
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
     * 新增记录
     *
     * Date: 2020/5/18
     * @param string $content
     * @return bool
     * @author chentulin
     */
    public function createRecord(string $content): bool
    {
        $dao             = new self();
        $dao->content    = $content;
        $dao->created_at = time();
        return $dao->save();
    }

    /**
     * 获取最新吐槽
     *
     * Date: 2020/5/18
     * @return string
     * @author chentulin
     */
    public function getNewSpeak(): string
    {
        return self::find()->orderBy(['created_at' => SORT_DESC])->limit(1)->one()->content;
    }

    /**
     * 获取前端接口
     *
     * Date: 2020/5/19
     * @return array
     * @author chentulin
     */
    public function getFrontList(): array
    {
        $query = new Query();
        $query->from(self::tableName());
        $query->select('*');

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 1
            ]
        ]);

        return [
            'dataList' => $dataProvider->getModels(),
            'pageInfo' => $dataProvider->getPagination(),
            'totalPage' => (int)ceil($dataProvider->totalCount / 1),
        ];
    }
}