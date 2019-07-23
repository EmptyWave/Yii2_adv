<?php
use yii\helpers\Html;
?>


<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
    'usersList' => $userList,
    'statusesList' => $taskStatuses,
]) ?>

</div>