<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

return [
  'id' => 'app-frontend',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log', 'bootstrap'],
  'controllerNamespace' => 'frontend\controllers',
  'components' => [
    'bootstrap' => [
      'class' => \app\components\Bootstrap::class
    ],
    'authManager' => [
      'class' => \yii\rbac\DbManager::class,
    ],
    'request' => [
      'csrfParam' => '_csrf-frontend',
    ],
    /*'user' => [
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
    ],*/
    'user' => [
      'identityClass' => 'common\models\User',
      'loginUrl' => ['/site/login'],
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
      'rules' => [
      ],
    ],

  ],
  'params' => $params,
  'modules' => [
    'admin' => [
      'class' => 'mdm\admin\Module',
      'layout' => 'left-menu',
      'mainLayout' => '@app/views/layouts/main.php',
      'controllerMap' => [
        'assignment' => [
          'class' => 'mdm\admin\controllers\AssignmentController',
          'userClassName' => 'common\models\User',
          'idField' => 'user_id',
          //'searchClass' => 'app\models\filters\UsersFilter'
        ],
        /*'other' => [
          'class' => 'path\to\OtherController', // add another controller
        ],*/
      ],
      'menus' => [
        'assignment' => [
          'label' => 'Grand Access'
        ],
        'route' => null, // disable menu route
      ]
    ],
  ],

  'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
      'site/*',
      'admin/*',
      'task/*',
    ]
  ],
];
