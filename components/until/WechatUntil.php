<?php

namespace app\components\until;

use app\components\EasyWechat;
use EasyWeChat\OfficialAccount\Application;

/**
 * 实例化公众号基础客户端
 * Class WechatUntil
 * @package app\components\until
 */
class WechatUntil
{
    public static $app;

    private $config = [
        'app_id' => 'wxc439cbfe9ee8140e',
        'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
        'token' => 'chentulin',
        'response_type' => 'array',
    ];

    private function __construct($type = 'array')
    {
        $this->app = EasyWeChat::getEasyWeChatOfficialAccount($this->config);
    }

    /**
     * 获取寄出客户端
     * Date: 2019/11/13
     * Author: ctl
     */
    public static function getInstance()
    {
        return self::$app;
    }

}