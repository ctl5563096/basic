<?php declare(strict_types=1);

namespace app\components\tra;

/**
 * 单例模式
 *
 * Trait Singletons
 * @package app\components\tra
 */
trait Singletons
{
    private static $instance;

    public static  function getInstance(int $database,string $password = ''){
        if(!isset(self::$instance)){
            self::$instance = new static(1,'');
        }
        return self::$instance;
    }
}