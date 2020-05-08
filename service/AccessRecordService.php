<?php declare(strict_types=1);


namespace app\service;

use app\dao\AccessRecordDao;

/**
 * 访问服务层
 *
 * Class AccessRecordService
 * @package app\service
 */
class AccessRecordService extends BaseService
{
    /**
     * 访问记录服务
     *
     * Date: 2020/5/8
     * @param array $params
     * @return bool
     * @author chentulin
     */
    public static function record(array $params): bool
    {
        return AccessRecordDao::record($params);
    }
}