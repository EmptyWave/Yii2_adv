<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 27.05.2019
 * Time: 11:28
 */

namespace app\assets;


use yii\web\AssetBundle;

class TaskAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/task.css',
  ];
  public $js = [
  ];
  public $depends = [
   // 'yii\web\YiiAsset',
   // 'yii\bootstrap\BootstrapAsset',
  ];
}