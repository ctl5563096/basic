<?php declare(strict_types=1);


namespace app\controllers\front;


use app\controllers\FrontController;
use app\service\PhotoService;

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
}