<?php declare(strict_types=1);


namespace app\controllers\backend;


use app\commands\BaseController;
use app\models\AdminUser;
use app\models\Role;
use app\models\RoleJurisdiction;
use app\models\User;

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

    /**
     * 添加权限
     * Date: 2019/12/17
     * @author chentulin
     */
    public function actionAdd()
    {
        if ($this->request->isGet){
            return $this->render('add');
        }else{
            $res = RoleJurisdiction::addJurisdiction($this->request->post());
            if ($res){
                $this->response->format = \yii\web\Response::FORMAT_JSON;
                $this->response->data = ['code' => 200 ,'msg' => '增加权限成功'];
            }else{
                $this->response->data = ['code' => 500 ,'msg' => '增加权限失败'];
            }
        }
    }

    /**
     * 分配角色
     * Date: 2019/12/17
     * @author chentulin
     */
    public function actionDistribution()
    {
        if ($this->request->isGet){
            // 查找所有角色
            $lists = Role::findRoleAll();
            // 加载分配角色
            return $this->render('distribution' ,array('lists' => $lists));
        }else{
            $data = $this->request->post();
            $bool = AdminUser::findByUserName($data['username']);
            $this->response->format = \yii\web\Response::FORMAT_JSON;
            if (empty($data['role_id'])){
                return $this->response->data = ['code' => 500 ,'msg' => '请选择权限'];
            }
            if ($bool && $data['username']){
                $res = AdminUser::updateRole($data['username'] ,$data['role_id']);
                if ($res){
                    return $this->response->data = ['code' => 200 ,'msg' => '更新权限成功'];
                }else{
                    return $this->response->data = ['code' => 500 ,'msg' => '更新权限失败'];
                }
            }else{
                return $this->response->data = ['code' => 500 ,'msg' => '用户名不能为空或者用户不存在'];
            }

        }
    }
}