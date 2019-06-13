<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Yii::$app->user->isGuest ?
  \frontend\widgets\IdentityAlert::widget([])
    :
  yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
      'tag' => 'div',
      'class' => 'task-container',
      'id' => 'task-list',
    ],
    'summary' => "",
    'itemView' => function ($model) {
      return \frontend\widgets\TaskView::widget(['model' => $model]);
    },
    'itemOptions' => [
      'tag' => false,
    ],
    'viewParams' => [
      'hide' => true
    ]
  ]);
?>