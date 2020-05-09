<?php declare(strict_types=1);


namespace app\apiService;

use GuzzleHttp\Client;

/**
 * http请求接口
 *
 * Class BaseApiService
 * @package app\apiService
 * @property Client $httpClient
 * @property string $url
 */
class BaseApiService
{
    /** @var  Client $httpClient */
    public $httpClient;

    /**
     * BaseApiService constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }
}