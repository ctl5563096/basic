<?php declare(strict_types=1);

namespace yii\components;

use EasyWeChat\Factory;

class EasyWechat
{
    /**
     * 获取基础客户端
     * @param $config
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function getEasyWeChatOfficialAccount($config)
    {
        return Factory::officialAccount($config);
    }
}