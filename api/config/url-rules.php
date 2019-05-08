<?php

/**
 * 在这里配置所有的路由规则
 */
$urlRuleConfigs = [
        [
        'controller' => ['v1/goods'],
        'extraPatterns' => [
            'GET xml' => 'xml',
            'GET write-xml' => 'write-xml',
            'GET add-log' => 'add-log'
        ]
    ],
        [
        'controller' => ['v1/user'],
        'extraPatterns' => [
            'POST login' => 'login',
            'GET signup-test' => 'signup-test',
            'GET user-profile' => 'user-profile',
            'GET kj' => 'kj'
        ]
    ],
];

/**
 * 基本的url规则配置
 */
function baseUrlRules($unit)
{
    $config = [
        'class' => 'yii\rest\UrlRule',
    ];
    return array_merge($config, $unit);
}

return array_map('baseUrlRules', $urlRuleConfigs);
