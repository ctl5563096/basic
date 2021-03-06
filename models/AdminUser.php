<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $phonenumber 密码
 * @property string $is_delete 是否删除
 * @property string $is_use 是否启用
 * @property int $role_id 角色id
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string', 'max' => 1024],
            [['is_delete', 'is_use'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'is_delete' => 'Is Delete',
            'is_use' => 'Is Use',
            'phonenumber' => 'phonenumber',
            'role_id' => 'Role Id'
        ];
    }

    /**
     * 根据用户名查找用户角色id
     * Date: 2019/12/12
     * @author chentulin
     */
    public static function findRole($userId)
    {
        return self::find()->where('username = :username' ,array(':username' => $userId))->one()->role_id;
    }

    /**
     * 检查用户名是否存在
     * Date: 2019/12/17
     * @param $username
     * @return bool
     * @author chentulin
     */
    public static function findByUserName($username) :bool
    {
        $row =  self::find()->where('username = :username' ,array(':username' => $username))->one();
        if ($row !== null){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新用户权限
     * Date: 2019/12/17
     * @param $username
     * @param $roleId
     * @return bool
     * @author chentulin
     */
    public static function updateRole($username ,$roleId):bool
    {
        $model = self::find()->where('username = :username' ,array(':username' => $username))->one();
        $model->role_id = $roleId;
        return  $model->save();
    }
}
