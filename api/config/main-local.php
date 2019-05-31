<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'W_LCB7p3L5LJK1xdAYrGQ18wnhRNlLrp',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser', //为了能够接收json格式的数据
            ]
        ],
    ],
];

if (!YII_ENV_TEST)
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
