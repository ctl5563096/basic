<?php

namespace app\components\core;


use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\base\BaseObject;
use yii\di\Instance;

abstract class BaseFacade
{
    /**
     *
     *  @return BaseObject|string|array|static
     */
    protected static function getFacadeAccessor()
    {
        throw new InvalidArgumentException('Facade does not implement getFacadeAccessor method');
    }


    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws InvalidConfigException
     * @author zhuozhen
     */
    public static function __callStatic($name, $arguments)
    {
        $service = Instance::ensure(static::getFacadeAccessor());
        return call_user_func_array([$service,$name],$arguments);
    }
}