<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\models\Role;
use app\models\RoleJurisdiction;
use foo\bar;


/**
 * 权限模块
 * Class JurisdictionController
 * @package app\controllers\backend
 */
class JurisdictionController extends BaseController
{
    /**
     * 权限模块
     * Date: 2019/12/16
     * @author chentulin
     */
    public function actionIndex()
    {
        $lists = [];
        $roleList = Role::roleList();
        $roleIds = [];
        foreach ($roleList as $key => $value){
            $roleIds[$value['role_name']] = RoleJurisdiction::findArrByRoleId($value['id']);
        }
        foreach ($roleIds as  $key => $value){
            $str = '';
            foreach ($value as $k => $v){
                $str .= $v['role_name'].',';
            }
            $lists[$key] = $str;
        }
        $lists = array_reverse($lists);
        return $this->render('index' ,array('lists' => $lists));
    }
}