<?php declare(strict_types=1);


namespace app\apiService;

use GuzzleHttp\Exception\ClientException;
use Yii;

/**
 * 心之天气服务
 *
 * Class weatherApiService
 * @package app\apiService
 * @property string $url
 */
class weatherApiService extends BaseApiService
{
    /**
     * @var string $url
     */
    public $url;

    /**
     * 通过ip获取今天天气
     *
     * Date: 2020/5/9
     * @return array
     * @author chentulin
     */
    public function getTodayWeatherByIp(): array
    {
        $this->url = 'https://api.seniverse.com/v3/weather/now.json?key='. Yii::$app->params['weather']['protect'] .'&location=ip&language=zh-Hans&unit=c';
        try{
            $res = $this->httpClient->request('GET' , $this->url);
            return json_decode($res->getBody()->getContents(), true);
        }catch (ClientException $e){
            // 防止请求失败请求北京天气
            $this->url = 'https://api.seniverse.com/v3/weather/now.json?key='. Yii::$app->params['weather']['protect'] .'&location=beijing&language=zh-Hans&unit=c';
            $res = $this->httpClient->request('GET' , $this->url);
            return json_decode($res->getBody()->getContents(), true);
        }
    }
}