<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\dao\ArticleDao;
use app\dto\ArticleDto;
use app\models\Article;
use Yii;

/**
 * 文章管理
 *
 * Class ArticleController
 * @package app\controllers\backend
 * @property string $userName
 * @property ArticleDto $articleDto
 * @property ArticleDao $articleDao
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

    /**
     * ArticleController constructor.
     * @param $id
     * @param $module
     * @param array $config
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userName   = Yii::$app->session->get('user');
        $this->articleDto = new ArticleDto();
        $this->articleDao = new ArticleDao();
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
}