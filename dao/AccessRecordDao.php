<?php declare(strict_types=1);


namespace app\dao;


use app\models\AccessRecord;
use yii\db\Query;

/**
 * 访问数据访问层
 *
 * Class AccessRecordDao
 * @package app\dao
 */
class AccessRecordDao extends AccessRecord
{
    /**
     * 博客访问数据访问层
     *
     * Date: 2020/5/8
     * @param array $params
     * @return bool
     * @author chentulin
     */
    public static function record(array $params): bool
    {
        $dao = new self();
        $dao->setAttributes($params);
        return $dao->save();
    }

    /**
     * 获取每日文章统计数
     *
     * Date: 2020/5/12
     * @param int $date
     * @return array
     * @author chentulin
     */
    public function getDayCount(int $date): array
    {
        $countAccess = [];
        $timeRes     = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($timeRes as $key => $value) {
            $num               = $key + 1;
            $beginTime         = $key * 3600 + $date;
            $endTime           = ($num * 3600 + $date) - 1;
            $data              = (new Query())
                ->from(self::tableName())
                ->select(['access_time'])
                ->where(['between', 'access_time', $beginTime, $endTime])
                ->count();
            $countAccess[$key] = (int)$data;
        }
        return $countAccess;
    }

    /**
     * Notes: 获取每周访问人数统计
     * @param int $date
     * @return array
     * @author: chentulin
     * Date: 2020/5/13
     * Time: 1:13
     */
    public function getWeekCount(int $date): array
    {
        $count   = [];
        $timeRes = [0, 0, 0, 0, 0, 0, 0];
        foreach ($timeRes as $key => $value) {
            $num         = $key + 1;
            $beginTime   = $key * 86400 + $date;
            $endTime     = ($num * 86400 + $date) - 1;
            $data        = (new Query())
                ->from(self::tableName())
                ->select(['access_time'])
                ->where(['between', 'access_time', $beginTime, $endTime])
                ->count();
            $count[$key] = (int)$data;
        }
        return $count;
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
        $count   = [];
        $timeRes = [0, 0, 0, 0];
        foreach ($timeRes as $key => $value) {
            $num         = $key + 1;
            $beginTime   = $key * 604800 + $date;
            $endTime     = ($num * 604800 + $date) - 1;
            $data        = (new Query())
                ->from(self::tableName())
                ->select(['access_time'])
                ->where(['between', 'access_time', $beginTime, $endTime])
                ->count();
            $count[$key] = (int)$data;
        }
        return $count;
    }

}