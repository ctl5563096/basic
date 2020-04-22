<?php

use app\components\TestComponent;
use yii\redis\Session;
use EasyWeChat\Factory;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
require_once __DIR__.'/di.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    // 修改默认路由
    'defaultRoute'=>'backend/login',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '2pMrXNQlXGqvnvDIc4ptphJzyQ6rB5d-',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\AdminUser',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'session' => [
            'class' => Session::class,
            'timeout' => 6000,
            'cookieParams' => ['lifetime' => 6000],
            'redis' => [
                    'hostname' => '127.0.0.1',
                    'port' => 6379,
                    //'password' => '', //没有密码，这行注意注释，不然报错密码错误
                    'database' => 0, //选择数据库
                    ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info','trace'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['rhythmk'],
                    'logFile' => '@app/runtime/logs/log.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
            ],
        ],
        'db' => $db,
	    'wechat' => [
        	'class' => Factory::class,
    	    ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'test' => [
            'class' => TestComponent::class
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to              add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
