<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_list".
 *
 * @property int $id
 * @property string $level 菜单等级
 * @property string $name 菜单名字
 * @property string $controller 控制器名
 * @property string $action 方法名
 * @property int $parent_id 菜单的父级 0就是顶级菜单
 * @property string $is_delete 是否删除
 * @property string $is_use 是否启用
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['level', 'name', 'controller', 'action'], 'string', 'max' => 255],
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
            'level' => 'Level',
            'name' => 'Name',
            'controller' => 'Controller',
            'action' => 'Action',
            'parent_id' => 'Parent ID',
            'is_delete' => 'Is Delete',
            'is_use' => 'Is Use',
        ];
    }
}
