<?php declare(strict_types=1);


namespace app\controllers\backend;

use app\commands\BaseController;
use app\dto\PhotoDto;
use app\service\PhotoService;
use yii\db\StaleObjectException;
use yii\web\UploadedFile;

/**
 * 相册管理模块
 *
 * Class PhotoController
 * @package app\controllers\backend
 * @property PhotoDto $photoDto
 * @property PhotoService $photoService
 */
class PhotoController extends BaseController
{
    /** @var PhotoDto $photoDto */
    public $photoDto;

    /** @var PhotoService $photoService */
    public $photoService;

    /**
     * PhotoController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->photoDto     = new PhotoDto();
        $this->photoService = new PhotoService();
    }

    /**
     * 渲染相册模板功能
     *
     * Date: 2020/5/13
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Notes: 新增相册模板渲染
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 3:33
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 上传接口
     *
     * Date: 2020/5/13
     * @return string
     * @author chentulin
     */
    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('file');
        if (!$file) {
            exit(json_encode([
                'code' => 400,
                'msg'  => '上传文件不能为空'
            ]));
        }
        $imageName = date('YmdHis');
        $ext       = $file->getExtension();
        $rootPath  = 'upload/image/';
        if (!file_exists($rootPath) && !mkdir($rootPath, 0777, true) && !is_dir($rootPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $rootPath));
        }
        $fullName = $rootPath . $imageName . '.' . $ext;
        if ($file->saveAs($fullName)) {
            exit(json_encode([
                'code' => 200,
                'msg'  => '上传成功',
                'url'  => $fullName
            ]));
        }
        exit(json_encode([
            'code' => 400,
            'msg'  => '上传文件失败'
        ]));
    }

    /**
     * Notes: 新建接口
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 2:39
     */
    public function actionCreate()
    {
        $params = $this->request->post();
        $this->photoDto->setAttributes($params);
        $this->photoDto->validate();
        $this->photoService->createPhoto($this->photoDto->getAttributes());
        exit(json_encode([
            'code' => 200,
            'msg'  => '新增相册成功'
        ]));
    }

    /**
     * Notes: 获取5天前的相册列表
     * @author: chentulin
     * Date: 2020/5/14
     * Time: 9:45
     */
    public function actionList()
    {
        $page = (int)$this->request->get('page');
        if ($page === 0) {
            $page = 1;
        }
        $list = $this->photoService->getList($page);
        exit(json_encode([
            'code'  => 200,
            'msg'   => '获取相册列表成功',
            'data'  => $list,
            'count' => $this->photoService->getCount()
        ]));
    }

    /**
     * 删除照片
     *
     * Date: 2020/5/14
     * @author chentulin
     */
    public function actionDelete()
    {
        $id  = (int)$this->request->get('id');
        $res = $this->photoService->delete($id);
        exit(json_encode([
            'code'  => 200,
            'msg'   => '删除成功'
        ]));
    }
}