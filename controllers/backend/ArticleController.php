<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\dao\ArticleDao;
use app\dto\ArticleDto;
use app\service\ArticleService;
use Yii;
use yii\web\Response;

/**
 * 文章管理
 *
 * Class ArticleController
 * @package app\controllers\backend
 * @property string $userName
 * @property ArticleDto $articleDto
 * @property ArticleDao $articleDao
 * @property ArticleService $articleService;
 */
class ArticleController extends BaseController
{
    /**
     * @var integer 用户id
     */
    public $userName;

    /**
     * @var ArticleDao $articleDao
     */
    public $articleDao;

    /** @var ArticleDto $articleDto */
    public $articleDto;

    /** @var ArticleService $articleService */
    public $articleService;

    /**
     * ArticleController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userName       = Yii::$app->session->get('user');
        $this->articleDto     = new ArticleDto();
        $this->articleDao     = new ArticleDao();
        $this->articleService = new ArticleService();
    }

    /**
     * 获取文章列表
     *
     * Date: 2020/3/19
     * @throws \Exception
     * @author chentulin
     */
    public function actionIndex()
    {
        if ($this->request->isAjax) {
            $dataList = $this->articleDao->getList((int)Yii::$app->session->get('user_id'), $this->request->post());
            exit(json_encode([
                'code' => 200,
                'msg'  => '获取列表成功',
                'list' => $dataList
            ]));
        }
        return $this->render('index');
    }

    /**
     * 添加文章
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function actionAdd()
    {
        if ($this->request->isAjax) {
            $params          = $this->request->post();
            $params['label'] = implode(',', array_keys($params['label']));
            $this->articleDto->setScenario($this->articleDto::SCENARIO_CREATE);
            $this->articleDto->setAttributes($params);
            $this->articleDto->validate();
            $this->articleDao->create($this->articleDto);

            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '添加成功'];
        }
        return $this->render('add');
    }

    /**
     * 改变文章展示状态
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function actionChangeStatus()
    {
        $this->articleService->changeStatusService((int)$this->request->get('id'));
    }

    /**
     * 删除文章
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function actionDelete()
    {
        $res = $this->articleService->delete((int)$this->request->get('id'));
        if ($res) {
            $this->response->format = Response::FORMAT_JSON;
            return $this->response->data = ['code' => 200, 'msg' => '删除成功'];
        }
    }

    /**
     * 查看文章内容
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function actionContent()
    {
        $content = $this->articleService->contentService((int)$this->request->get('id'));
        return $this->render('content', array('content' => $content));
    }

    /**
     * 修改文章
     *
     * Date: 2020/5/5
     * @author chentulin
     */
    public function actionDetail()
    {
        if ($this->request->isAjax) {
            $params          = $this->request->post();
            $params['label'] = implode(',', array_keys($params['label']));
            $this->articleDto->setScenario('update');
            $this->articleDto->setAttributes($params);
            $this->articleDto->validate();
            $res = $this->articleService->updateService($this->articleDto, (int)$this->request->get('id'));
            if ($res) {
                $this->response->format = Response::FORMAT_JSON;
                return $this->response->data = ['code' => 200, 'msg' => '修改成功'];
            }
        }
        $detail = $this->articleService->detailService((int)$this->request->get('id'));
        $label  = explode(',', $detail->label);
        return $this->render('detail', array('detail' => $detail, 'label' => $label));
    }
}
