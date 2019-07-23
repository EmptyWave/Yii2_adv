<?php

use frontend\models\tables\TaskStatuses;
use yii\helpers\Html;
use frontend\models\tables\Users;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\tables\Task */
/* @var $usersList[] \app\controllers\AdminTaskController */
/* @var $statusesList[] \app\controllers\AdminTaskController */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usersList' => $usersList,
        'statusesList' => $statusesList,
    ]) ?>

</div>
