<?php declare(strict_types=1);


namespace app\dao;


use app\models\Speak;
use yii\data\ActiveDataProvider;

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
     * @author chentulin
     * @param string $content
     * @return bool
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
     * @author chentulin
     * @return string
     */
    public function getNewSpeak(): string
    {
        return self::find()->orderBy(['created_at' => SORT_DESC])->limit(1)->one()->content;
    }
}