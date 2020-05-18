<?php declare(strict_types=1);


namespace app\dao;


use app\models\Photo;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * 相册数据访问层
 *
 * Class PhotoDao
 * @package app\dao
 */
class PhotoDao extends Photo
{
    /**
     * Notes: 新增相册
     * @param array $params
     * @return bool
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 2:55
     */
    public function createPhoto(array $params): bool
    {
        $dao = new self();
        $dao->setAttributes($params);
        $dao->upload_time = time();
        return $dao->save();
    }

    /**
     * Notes: 获取近五天新增相册列表
     * @param int $page
     * @return array
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 3:56
     */
    public function getList(int $page): array
    {
        $endTime   = (strtotime(date('Y-m-d')) + 86400 - 1) - ($page - 1) * 86400 * 5;
        $startTime = strtotime(date('Y-m-d')) - 86400 * $page * 5;
        $query     = new Query();
        $query->from(self::tableName());
        $query->select('*');
        $query->where(['>', 'upload_time', $startTime]);
        $query->andWhere(['<', 'upload_time', $endTime]);
        $query->orderBy('upload_time');
        return $query->all();
    }

    /**
     * 数据提供层获取图片列表
     *
     * Date: 2020/5/18

     * @return array
     * @author chentulin
     */
    public function getFrontList(): array
    {
        $query = new Query();
        $query->from(self::tableName());
        $query->select('*');
        $query->orderBy(['upload_time' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return [
            'dataList'  => $provider->getModels(),
            'totalPage' => (int)ceil($provider->totalCount / 5),
        ];
    }
}