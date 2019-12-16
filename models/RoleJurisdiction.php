<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

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
     * 根据角色Id找出所有权限
     * Date: 2019/12/12
     * @param $roleId
     * @return array
     * @author chentulin
     */
    public static function findArrByRoleId($roleId):array
    {
        $row = (new Query())->select('controller,action,role_name')->from('role_jurisdiction')->where('role_id = :role_id')->addParams(array(':role_id' => $roleId))->all();
        if (!$row){
            return [];
        }
        return $row;
    }
}
