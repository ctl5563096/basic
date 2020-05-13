<?php declare(strict_types=1);


namespace app\service;

use app\dao\AccessRecordDao;

/**
 * 访问服务层
 *
 * Class AccessRecordService
 * @package app\service
 * @property AccessRecordDao $accessDao
 */
class AccessRecordService extends BaseService
{
    /** @var AccessRecordDao $accessDao */
    public $accessDao;

    /**
     * AccessRecordService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->accessDao = new AccessRecordDao();
    }

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

    /**
     * 获取每日访问统计
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
                return $this->accessDao->getDayCount($date);
            case 'week':
                return $this->accessDao->getWeekCount($date);
            case 'month':
                return $this->accessDao->getMonthCount($date);
        }
        return [];
    }
}