<?php declare(strict_types=1);


namespace app\dao;


use app\models\AccessRecord;

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
}