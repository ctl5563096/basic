<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\models\Role;
use app\models\RoleJurisdiction;

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
            $arr = [];
            if (!json_decode($value['role_arr'])){
                $roleIds[$value['role_name']] = $arr;
            }else{
                $roleIds[$value['role_name']] = json_decode($value['role_arr']);
            }
        }
        foreach ($roleIds as  $key => $value){
            $str = '';
            if ($roleIds[$key] !== []){
                foreach ($value as $k => $v){
                   $res =  RoleJurisdiction::findById($v);
                   $str .= $res['role_name'].',';
                }
            }
            $lists[$key] = $str;
        }
        $lists = array_reverse($lists);
        return $this->render('index' ,array('lists' => $lists));
    }

    /**
     * 修改角色权限
     * DATE : 2019/12/16 22:33
     * @author chentulin
     */
    public function actionEdit()
    {
        if ($this->request->isGet){
            $roleName = $this->request->get('role_name');
            // 找出所有权限
            $jList = RoleJurisdiction::findJurisdictionAll();
            // 找出角色所拥有的的权限
            $jRole = Role::findByName($roleName);
            // 找出角色对应的角色名
            $roleId = Role::find()->select('*')->where('role_name = :role_name', [':role_name' => $roleName])->one()->id;
            return $this->render('edit' ,array('jList' => $jList ,'jRole' => $jRole ,'role_name' => $roleName ,'roleId' => $roleId));
        }else{
            $this->response->format = \yii\web\Response::FORMAT_JSON;
            $roleArrs = $this->request->post('role');
            $id = $this->request->post('id');
            // 更新权限组
            $res = Role::updateRole($id ,$roleArrs);
            if ($res){
                $this->response->data = ['code' => 200 ,'msg' => '修改权限成功'];
            }else{
                $this->response->data = ['code' => 500 ,'msg' => '修改权限失败'];
            }
        }
    }
}