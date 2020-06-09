<?php declare(strict_types=1);


namespace app\dao;


use app\models\ShopUser;

/**
 * 商城用户数据访问层
 *
 * Class ShopUserDao
 * @package app\dao
 */
class ShopUserDao extends ShopUser
{
    /**
     * 根据openid查询用户信息
     *
     * Date: 2020/6/9
     * @author chentulin
     * @param string $openid
     * @return array
     */
    public static function findByOpenId(string $openid): array
    {
        $userInfo = self::findOne(['openid' => $openid])->toArray();
        // 判断是否为空
        if (empty($userInfo)){
            return [];
        }
        return $userInfo;
    }

    /**
     * 新建微信商城用户
     *
     * Date: 2020/6/9
     * @param array $userInfo
     * @return void | bool
     * @author chentulin
     */
    public function createShopUser(array $userInfo)
    {
        $dao = new self();
        $dao->openid = $userInfo['FromUserName'];
        $dao->created_at = time();
        $dao->sub_time = $userInfo['CreateTime'];
        $res = $dao->save();
        if (!$res){
            return current($dao->getFirstErrors());
        }else{
            return true;
        }
    }

    /**
     * 取关事件
     *
     * Date: 2020/6/9
     * @param string $openid
     * @return bool
     * @author chentulin
     */
    public function unSubscribeStatus(string $openid): bool
    {
        $dao = self::findOne(['openid' => $openid]);
        $dao->is_sub = 0;
        $dao->un_sub_time = time();
        return $dao->save();
    }
}