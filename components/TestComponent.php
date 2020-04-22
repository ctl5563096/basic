<?php declare(strict_types=1);


namespace app\components;

use yii\base\Component;

/**
 * 测试自定义组件
 *
 * Class TestComponent
 * @package yii\components\MyClass
 */
class TestComponent extends Component
{
    /**
     * Date: 2020/3/30
     * @author chentulin
     */
    public function  test()
    {
        echo '测试组件方法';
    }
}