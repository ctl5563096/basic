<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use app\models\Role;

/**
 * This is the model class for table "role_jurisdiction".
 *
 * @property int $id
 * @property int $role_id 权限对应的角色id
 * @property string $controller 控制器名
 * @property string $action 方法名
 * @property string $role_name 方法名
 */
class RoleJurisdiction extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_jurisdiction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['controller', 'action'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'controller' => 'Controller',
            'action' => 'Action',
            'role_name' => 'role_name',
        ];
    }

    /**
     * 找出所有权限
     * DATE : 2019/12/16 22:46
     * @author chentulin
     * @return array
     */
    public static function findJurisdictionAll() :array
    {
        return  (new Query())->select('*')->from('role_jurisdiction')->all();
    }

    /**
     * 根据用户名查找角色拥有的权限
     * DATE : 2019/12/16 22:50
     * @param $roleName
     * @return array
     * @author chentulin
     */
    public static function findByRole($roleName) :array
    {
        $roleId = Role::find()->select('id')->where('role_name = :role_name', [':role_name' => $roleName])->one()->id;
        // 根据角色Id查出所有的权限
        $role_list = (new Query())->select('*')->from('role_jurisdiction')->where('role_id = :id' ,[':id' => $roleId])->all();
        return $role_list;
    }

    /**
     * 根据ID查出对应的权限细节
     * @param $id
     * DATE : 2019/12/17 1:11
     * @return array
     * @author chentulin
     */
    public static function findById($id) :array
    {
        return (new Query())->select('*')->from(self::tableName())->where('id = :id', [':id' => $id])->one();
    }

    /**
     * 新增权限
     * Date: 2019/12/17
     * @author chentulin
     * @param $data
     * @return bool
     */
    public static function addJurisdiction($data) :bool
    {
        $model = new self();
        $model->controller = $data['controller_name'];
        $model->action = $data['action_name'];
        $model->role_name = $data['jurisdiction_name'];
        return $model->save();
    }
}
