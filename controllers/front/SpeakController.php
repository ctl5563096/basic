<?php declare(strict_types=1);


namespace app\controllers\front;


use app\controllers\FrontController;
use app\service\SpeakService;

/**
 * 碎碎念控制器
 *
 * Class SpeakController
 * @package app\controllers\front
 * @property SpeakService $speakService
 */
class SpeakController extends FrontController
{
    /** @var SpeakService $speakService */
    public $speakService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->speakService = new SpeakService();
    }

    /**
     * Notes: 渲染页面
     * @author: chentulin
     * Date: 2020/5/18
     * Time: 20:37
     */
    public function actionIndex()
    {
        // 判断是否为Ajax请求
        if ($this->request->isAjax) {
            $list = $this->speakService->getFrontList();
            exit(json_encode(
                [
                    'code'     => 200,
                    'msg'      => '获取成功',
                    'dataList' => $list
                ]
            ));
        }
        return $this->render('index');
    }
}