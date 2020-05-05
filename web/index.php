<?php
$f      = getenv('HTTP_X_FORWARDED_FOR');
$server = getenv('HTTP_HOST');
if (($f !== '') && ($server !== 'www.ctllys.top') && ($server !== 'www.ctllys.top')) {
    echo '本服务器禁止恶意反向代理！';
	die;
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
