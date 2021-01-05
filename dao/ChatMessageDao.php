<?php declare(strict_types=1);


namespace app\dao;


use app\models\ChatMessage;
use yii\data\ActiveDataProvider;

/**
 * 数据传输层
 *
 * Class ChatMessageDao
 * @package app\dao
 */
class ChatMessageDao extends ChatMessage
{
    /**
     * Notes: 新增聊天记录
     *
     * Author: chentulin
     * DateTime: 2020/11/10 19:42
     * E-MAIL: <chentulinys@163.com>
     * @param array $data
     */
    public function createRecord(array $data): bool
    {

    }

    /**
     * Notes: 获取对应客服初始化未读信息用户
     *
     * Author: chentulin
     * DateTime: 2020/11/10 19:44
     * E-MAIL: <chentulinys@163.com>
     * @param int $customId
     * @param array $params
     * @return array
     */
    public function getNotReadUserMessageRecord(int $customId, array $params): array
    {
        // 页数
        if (!isset($params['page'])) {
            $page = 1;
        } else {
            $page = $params['page'];
        }
        $query     = self::find()->select('a.id as id,a.openid,b.head_img_url,b.nickname')
            ->alias('a')
            ->join('LEFT JOIN', 'shop_user as b', 'a.openid = b.openid')
            ->where(['a.custom_id' => $customId])
            ->andWhere(['a.is_read' => 1])
            ->groupBy('a.openid')
            ->orderBy(['b.id' => SORT_DESC]);
        $provider  = new ActiveDataProvider([
            'query'      => $query->asArray(),
            'pagination' => [
                'pageSize' => 10,
                'page'     => $page - 1,
            ],
        ]);
        $dataList  = $provider->getModels();
        $openidArr = array_column($dataList, 'openid');
        // 获取每个用户有多少条未读信息
        $queryNotReadData = self::find()->select('count(*) as count ,openid')
            ->where(['in', 'openid', $openidArr])
            ->groupBy('openid')
            ->asArray()
            ->all();
        $tempArr          = array_column($queryNotReadData, null, 'openid');
        foreach ($dataList as &$v) {
            $v['notRead'] = $tempArr[$v['openid']]['count'];
        }
        return [
            'dataList'   => $dataList,
            'totalCount' => $provider->totalCount,
        ];
    }

    /**
     * Notes: 数据传输层获取未读用户信息
     *
     * Author: chentulin
     * DateTime: 2021/1/4 17:06
     * E-MAIL: <chentulinys@163.com>
     * @param string $openid
     * @return array
     */
    public function getUserNotReadMessage(string $openid)
    {
        $result = self::find()->select('*')
            ->where(['openid' => $openid])
            ->orderBy(['created_time' => SORT_ASC])
            ->limit(100)
            ->asArray()
            ->all();

        //  获取用户基本信息
        $userInfo = ShopUserDao::find()->select('*')
            ->where(['openid' => $openid])
            ->asArray()
            ->one();

        // 组装数据
        $data = [
            'message'   => $result,
            'userName'  => $userInfo['nickname'],
            'headerUrl' => $userInfo['head_img_url'],
        ];
        return $data;
    }
}