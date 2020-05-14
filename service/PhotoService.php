<?php declare(strict_types=1);


namespace app\service;

use app\dao\PhotoDao;
use app\logic\PhotoLogic;

/**
 * 相册服务层
 *
 * Class PhotoService
 * @package app\service
 * @property PhotoDao $photoDao
 * @property PhotoLogic $photoLogic
 */
class PhotoService extends BaseService
{
    /** @var PhotoDao $photoDao */
    public $photoDao;

    /** @var PhotoLogic $photoLogic */
    public $photoLogic;

    /**
     * PhotoService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->photoDao = new PhotoDao();
        $this->photoLogic = new PhotoLogic();
    }

    /**
     * Notes: 新增相册
     * @param array $dto
     * @return bool
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 2:48
     */
    public function createPhoto(array $dto): bool
    {
        return $this->photoDao->createPhoto($dto);
    }

    /**
     * Notes: 获取相册列表
     * @param int $page
     * @return array
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 3:39
     */
    public function getList(int $page): array
    {
        $list =  $this->photoDao->getList($page);
        return  $this->photoLogic->getDayPhoto($list,$page);
    }

    /**
     * 获取总条数
     *
     * Date: 2020/5/14
     * @author chentulin
     * @return int
     */
    public function getCount(): int
    {
        return (int)$this->photoDao::find()->count();
    }

    /**
     *
     * Date: 2020/5/14
     * @param int $id
     * @return int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @author chentulin
     */
    public function delete(int $id): bool
    {
        $dao = $this->photoDao::findOne(['id' => $id]);
        if (!$dao){
            exit(json_encode([
                'code'  => 400,
                'msg'   => '没有找到资源',
            ]));
        }
        $url = $dao->url;
        $num = $dao->delete();
        return $num > 0 && unlink($url);
    }
}