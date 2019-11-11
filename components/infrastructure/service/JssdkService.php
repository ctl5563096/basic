<?php declare(strict_types=1);

namespace app\components\infrastructure\service;


interface JssdkService
{
    /**
     * @param array $apis
     * @return array
     * @author zhuozhen
     */
    public function getSdkConfig(array $apis) ;
}