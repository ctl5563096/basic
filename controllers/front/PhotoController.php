<?php declare(strict_types=1);


namespace app\controllers\front;


use app\controllers\FrontController;
use app\service\PhotoService;
use yii\web\Response;

/**
 * 照相墙
 *
 * Class PhotoController
 * @package app\controllers\front
 * @property PhotoService $photoService
 */
class PhotoController extends FrontController
{
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
        $this->photoService = new PhotoService();
    }

    /**
     * 渲染页面
     *
     * Date: 2020/5/14
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 获取图片列表
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public function actionList()
    {
        $res    = $this->photoService->getFrontList();
        $this->response->format = Response::FORMAT_JSON;
        return $this->response->data = ['code' => 200, 'msg' => '成功','dataList' => $res];
    }
}