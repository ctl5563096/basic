<?php


namespace app\components\facade;


use app\components\core\BaseFacade;
use app\components\infrastructure\service\JssdkService;

/**
 * Class JssdkFacade
 * @package app\components\facade
 * @method static getSdkConfig(array $array)
 */
class JssdkFacade extends BaseFacade
{
    /**
     *
     *  @return Object|string|null
     */
    protected static function getFacadeAccessor()
    {
        return JssdkService::class;
    }
}