<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = Yii::t('app','title_edit_task').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="task-update">

  <?= $this->render('forms/_form', [
    'model' => $model,
    'usersList' => $usersList,
    'statusList' => $statusList,
  ]) ?>

</div>
