<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => "home",
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'backend_user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'backend\models\BackendUser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        //去除 JQuery 脚本
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [], // 去除 jquery.js
                    'sourcePath' => null, // 防止在/web/asset 下生产文件
                ],
            ],
        ]
    ],
    'params' => $params,
];
