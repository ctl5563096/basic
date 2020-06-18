<?php declare(strict_types=1);


namespace app\components;

use app\components\tra\Singletons;

/**
 * 实例化redis客户端
 *
 * Class Redis
 * @package yii\components
 * @property \Redis $redis;
 */
class Redis
{
    use Singletons;
    /** @var \Redis $redis */
    public $redis;

    /**
     * 实例化构造函数
     *
     * Redis constructor.
     * @param int $database
     * @param string $password
     */
    public function __construct(int $database,string $password ='')
    {
        //封装redis实例作为测试
        $this->redis = new \Redis();
        $this->redis->pconnect("127.0.0.1",6379);
        $this->redis->auth($password);
        $this->redis->select($database);
    }

    /**
     * 返回redis对象,
     *
     * Date: 2020/6/11
     * @author chentulin
     * @return \Redis
     */
    public function getRedis()
    {
        return $this->redis;
    }
}