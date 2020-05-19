<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\service\SpeakService;

/**
 * 说点什么控制器
 *
 * Class SpeakController
 * @package app\controllers\backend
 * @property SpeakService $speakService
 */
class SpeakController extends BaseController
{
    /** @var SpeakService $speakService */
    public $speakService;

    /**
     * SpeakController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->speakService = new SpeakService();
    }

    /**
     * 渲染页面
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 获取数据
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public function actionGetList()
    {
        $params = $this->request->post();
        $list   = $this->speakService->getList($params);
        exit(json_encode([
            'code' => 200,
            'msg'  => '获取列表成功',
            'list' => $list
        ]));
    }

    /**
     * 获取数据
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public function actionAdd()
    {
        if ($this->request->isAjax){
            $content = $this->request->post('content');
            $res = $this->speakService->createRecord((string)$content);
            if ($res){
                exit(json_encode([
                    'code' => 200,
                    'msg'  => '新增成功',
                ]));
            }
        }
        return $this->render('add');
    }

    /**
     * 获取数据
     *
     * Date: 2020/5/18
     * @author chentulin
     */
    public function actionDelete()
    {
        $id  = $this->request->get('id');
        $res = $this->speakService->delete((int)$id);
        if ($res > 0) {
            exit(json_encode([
                'code' => 200,
                'msg'  => '删除成功',
            ]));
        }
    }
}