<?php

namespace app\components\infrastructure\service\impl;

use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use EasyWeChat\Kernel\Exceptions\RuntimeException;
use EasyWeChat\OfficialAccount\Application;
use Psr\SimpleCache\InvalidArgumentException;
use Yii;
use yii\base\BaseObject;
use app\components\infrastructure\service\JssdkService;
use yii\components\EasyWechat;

/**
 * Class JssdkServiceImpl
 * @package app\components\infrastructure\service\impl
 * @property $config
 */
class JssdkServiceImpl
{
    protected  $config = [
        'app_id' => 'wxc439cbfe9ee8140e',
        'secret' => 'b2bf1b59f797e4c0cea4c44b4bfe81f9',
        'token' => 'chentulin',
        'response_type' => 'array',
    ];

    public function getSdkConfig(array $apis) : array
    {
        try {
            return EasyWeChat::getEasyWeChatOfficialAccount($this->config)->jssdk->buildConfig($apis,YII_DEBUG,false,false);
        } catch (InvalidConfigException $e) {
            Yii::info($e->getMessage());
        } catch (RuntimeException $e) {
            Yii::info($e->getMessage());
        } catch (InvalidArgumentException $e) {
            Yii::info($e->getMessage());
        }
        return [];
    }
}