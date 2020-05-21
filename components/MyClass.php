<?php 

namespace yii\components;


use yii\base\BaseObject;


class MyClass extends BaseObject
{
    public $prop1 = 1;
    public $prop2 = 2;

    public function __construct($param1, $param2, $config = [])
    {
        // ... 在应用配置之前初始化

        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        // ... 应用配置后进行初始化
    }
}
