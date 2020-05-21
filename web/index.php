<?php
$f      = getenv('HTTP_X_FORWARDED_FOR');
$server = getenv('HTTP_HOST');
if ($_SERVER['SERVER_ADDR'] !== '127.0.0.1'){
    if (($f !== '') && ($server !== 'www.ctllys.top') && ($server !== 'www.ctllys.top')) {
        echo '本服务器禁止恶意反向代理！';
        die;
    }
}


// comment out the following two lines when deployed to production 关闭调试模式
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// 判断加载是加载本地的还是线上的
if(file_exists(__DIR__ . '/../config/web_local.php')){
    $config = require __DIR__ . '/../config/web_local.php';
}else{
    $config = require __DIR__ . '/../config/web.php';
}

(new yii\web\Application($config))->run();
