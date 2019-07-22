<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language' => 'en',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@img' => '@frontend/web/img/',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => "@app/messages"
                ],
                'view*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => "@app/messages"
                ],
            ]
        ],
        'bootstrap' => [
            'class' => \frontend\components\Bootstrap::class
        ],
//        'cache' => [
////            'class' => 'yii\caching\FileCache',
//            'class' => 'yii\redis\Cache',
//        ],
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => 'localhost',
//            'port' => 6379,
//            'database' => 0,
//        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
//            'cookieValidationKey' => 'o70eH_h6H29D73PeQSNLuFbtUQZ9TzWi', из yii2-base
        ],
        'user' => [
//            'identityClass' => \app\models\UserIdentity::class, из yii2 base
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
        //URL-менеджер, вместо site?r=controller/action/... используется: site/controller/action/id...
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'task/<page>/<per-page>' => 'task/index',
                'tasks' => 'task/index',
//                'task/<id>' => 'task/one',
                'GET task/<id>' => 'task/one',
                'GET/POST admin-task/update-<id>' => 'admin-task/update',
                'GET admin-task/view-<id>' => 'admin-task/view',
//                'POST task/<id>' => 'task/two'
            ],
        ],

    ],
    'params' => $params,
];
