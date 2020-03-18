<?php declare(strict_types=1);

namespace app\dao;

use app\models\AdminUser;
use yii\data\ActiveDataProvider;

/**
 * 用户访问层`
 *
 * Class UserDao
 */
class UserDao extends AdminUser
{
    /**
     * 获取用户列表
     *
     * Date: 2020/3/17
     * @param array $params
     * @return UserDao[]
     * @author chentulin
     */
    public function getList(array $params): array
    {
        $query    = self::find()
            ->select('u.*,r.role_name')
            ->alias('u')
            ->where(['u.is_delete' => 'no'])
            ->leftJoin('role as r','u.role_id = r.id');
        $provider = new ActiveDataProvider([
            'query'      => $query->asArray(),
            'pagination' => [
                'pageSize' => $params['pageSize'],
            ],
        ]);
        return [
            'dataList'   => $provider->models,
            'totalCount' => $provider->totalCount,
        ];
    }


    /**
     * 修改用户启用状态
     *
     * Date: 2020/3/18
     * @param int $id
     * @return bool
     * @author chentulin
     */
    public function changeStatus(int $id): bool
    {
        $model = self::findOne(['id' => $id]);
        if (!$model){
            exit(json_encode([
                'code' => 400,
                'msg'  => '修改用户状态失败',
            ]));
        }
        if ($model->is_use === 'yes'){
            $model->is_use = 'no';
        }else{
            $model->is_use = 'yes';
        }
        return $model->save();
    }
}