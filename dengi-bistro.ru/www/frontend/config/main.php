<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'main',
    'language' => 'ru',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'.html',
            'rules' => [
                [ 
                'pattern' => 'gii', 
                'route' => 'gii', 
                'suffix'=>'', 
                ], 
                //'<alias:[\w_\/-]+>'=>'main/landing'
                //'<alias:.+>' => 'main/landing',
                "" => 'main/index',
                //'blog'=>'main/blog',
                [
                    'pattern' => 'blog',
                    'route' => 'main/blog',
                    'suffix'=>'',
                ],
                "krediti/<alias>"=>"main/company",
                "main/logout"=>"main/logout",
                'main/link'=>'main/link',
                //'main/plus'=>'main/plus',
                [
                    'pattern' => 'main/plus',
                    'route' => 'main/plus',
                    'suffix'=>'',
                ],
                [
                    'pattern' => 'main/minus',
                    'route' => 'main/minus',
                    'suffix'=>'',
                ],
                //'main/minus'=>'main/minus',
                //'about'=>'main/about', 
                'vse-kompanii'=>'main/vse-kompanii',
                [
                    'pattern' => '<alias:.+>',
                    'route' => 'main/landing',
                    'encodeParams' => false,
                ],
                
            ],
        ],
        
    ],
    'params' => $params,
];
