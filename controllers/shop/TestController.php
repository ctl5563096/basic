<?php declare(strict_types=1);

namespace app\controllers\shop;

use app\controllers\ShopBaseController;


class TestController extends ShopBaseController
{
    public function  actionIndex()
    {
        var_dump('1');die();
    }

    public function  actionTest()
    {
        var_dump(\Yii::$app->session->get('openid'));die();
    }
}