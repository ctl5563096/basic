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
     * @param array $dto
     * @return bool
     * @author: chentulin
     * Date: 2020/5/8
     * Time: 21:44
     */
    public function createRecord(array $params,array $dto): bool
    {
        return $this->messageBoardDao->createRecord($params,$dto);
    }

    /**
     * Notes:
     * @return array
     * @author: chentulin
     * Date: 2020/5/9
     * Time: 1:13
     */
    public static function findHotMessage(): array
    {
        return MessageBoardDao::find()->select(['content','name','created_at'])->where(['is_delete' => 0])->orderBy(['created_at' => SORT_ASC])->asArray()->limit(3)->all();
    }
}