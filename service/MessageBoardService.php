<?php declare(strict_types=1);


namespace app\service;

use app\dao\MessageBoardDao;

/**
 * 留言板数据服务层
 *
 * Class MessageBoardService
 * @package app\service
 * @property MessageBoardDao $messageBoardDao
 */
class MessageBoardService extends BaseService
{
    /** @var MessageBoardDao $messageBoardDao */
    public $messageBoardDao;

    public function __construct()
    {
        parent::__construct();
        $this->messageBoardDao = new MessageBoardDao();
    }

    /**
     * 新增留言记录
     *
     * Notes:
     * @param array $params
     * @return bool
     * @author: chentulin
     * Date: 2020/5/8
     * Time: 21:44
     */
    public function createRecord(array $params): bool
    {
        return $this->messageBoardDao->createRecord($params);
    }
}