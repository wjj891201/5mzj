<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 10,
            'storageMap' => [
                'user_credentials' => 'common\models\User',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ]
    ],
    'components' => [
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->statusCode == 200)
                {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'code' => $response->statusCode,
                        'data' => $response->data,
                        'message' => $response->statusText
                    ];
                }
                else
                {
                    $exception = Yii::$app->getErrorHandler()->exception;
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'code' => $response->statusCode,
                        'data' => [
                            'name' => ($exception instanceof Exception || $exception instanceof ErrorException) ? $exception->getName() : 'Exception',
                            'file' => $exception->getFile(),
                            'errorMessage' => $exception->getMessage(),
                            'line' => $exception->getLine(),
                            'type' => get_class($exception)
                        ],
                        'message' => $response->statusText
                    ];
                }
                $response->format = yii\web\Response::FORMAT_JSON;
            }
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null
        ],
//        'session' => [
//            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
//        ],
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
//            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
//            'rules' => require(__DIR__ . '/url-rules.php'),
            'rules' => [
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
            ],
        ]
    ],
    'params' => $params
];
