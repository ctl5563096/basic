<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $role_name 角色名
 * @property string $role_arr 权限组
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_name'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_name' => 'Role Name',
            'role_arr' => 'Role Arr',
        ];
    }

    /**
     * 查找所有的角色
     * DATE : 2019/12/12 23:32
     * @author chentulin
     */
    public static function findRoleAll() :array
    {
        $row = (new Query())->select('*')->from(self::tableName())->all();
        return $row;
    }

    /**
     * @param $roleName
     * DATE : 2019/12/13 0:21
     * @return bool
     * @author chentulin
     */
    public static function addRole($roleName) :bool
    {
        $model = (new self());
        $model->role_name = $roleName;
        return $model->save();
    }

    /**
     * Date: 2019/12/16
     * @author chentulin
     */
    public static function roleList() :array
    {
        $list = (new Query())
            ->select('*')
            ->from(self::tableName())
            ->all();
        return  $list;
    }

    /**
     * 根据用户名所属权限组
     * DATE : 2019/12/17 0:23
     * @param $roleName
     * @return array
     * @author chentulin
     */
    public static function findByName($roleName) :array
    {
        $res = Role::find()->select('role_arr')->where('role_name = :role_name', [':role_name' => $roleName])->one()->role_arr;
        if ($res){
            return json_decode($res);
        }else{
            return [];
        }
    }

    /**
     * 根据角色ID找出权限数组
     * @param $roleId
     * DATE : 2019/12/17 0:59
     * @author chentulin
     * @return int
     */
    public static function findArrByRoleId($roleId)
    {
        $str = (new Query())->select('role_arr')->from('role')->where('id = :rid', [':rid' => $roleId])->one();
        return json_decode($str['role_arr']);
    }

    /**
     * 更新权限组
     * @param $id
     * @param $roleArre
     * DATE : 2019/12/17 1:55
     * @author chentulin
     * @return bool
     */
    public static function updateRole($id ,$roleArr) :bool
    {
        try{
           $model =  Role::findOne([
               'id' => $id
           ]);
           $model->role_arr = json_encode($roleArr);
           return  $model->save();
        }catch (\Exception $e){
            throw new $e->getMessage();
        }
    }
}
