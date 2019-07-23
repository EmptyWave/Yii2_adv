<?php
return [
  'name' => '+Task',
  'language' => 'en',
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
    '@mdm/admin' => '@vendor/mdm/yii2-admin',
  ],
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'components' => [
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'i18n' => [
      'translations' => [
        'app*' => [
          'class' => \yii\i18n\PhpMessageSource::class,
          'basePath' => '@common/messages'
        ]
      ]
    ],
  ],

];
