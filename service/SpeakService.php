<?php declare(strict_types=1);


namespace app\service;

use app\dao\SpeakDao;

/**
 * 说点什么服务层
 *
 * Class SpeakService
 * @package app\service
 * @property SpeakDao $speakDao
 */
class SpeakService extends BaseService
{
    /** @var SpeakDao $speakDao */
    public $speakDao;

    /**
     * SpeakService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->speakDao = new SpeakDao();
    }

    /**
     * 获取列表服务层
     *
     * Date: 2020/5/18
     * @param array $params
     * @return array
     * @author chentulin
     */
    public function getList(array $params): array
    {
        return $this->speakDao->getList($params);
    }

    /**
     * 删除记录
     *
     * Date: 2020/5/18
     * @param int $id
     * @return int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @author chentulin
     */
    public function delete(int $id): int
    {
        $dao = $this->speakDao::findOne(['id' => $id]);
        if (!$dao){
            exit(json_encode([
                'code' => 400,
                'msg'  => '删除失败',
            ]));
        }
        return $dao->delete();
    }

    /**
     * 服务层新增字段
     *
     * Date: 2020/5/18
     * @param string $content
     * @return bool
     * @author chentulin
     */
    public function createRecord(string $content): bool
    {
        return $this->speakDao->createRecord($content);
    }

    /**
     * 获取最新吐槽
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public static function getNewSpeak():string
    {
        return (new speakDao)->getNewSpeak();
    }

    /**
     * Notes: 获取前台碎碎念接口
     * @return array
     * @author: chentulin
     * Date: 2020/5/18
     * Time: 20:52
     */
    public function getFrontList(): array
    {
        return $this->speakDao->getFrontList();
    }
}