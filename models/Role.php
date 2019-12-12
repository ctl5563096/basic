<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $role_name 角色名
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
}
