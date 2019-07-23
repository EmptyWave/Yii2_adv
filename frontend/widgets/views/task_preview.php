<?php
use yii\helpers\Url;

/** @var $model \frontend\models\tables\Task*/
?>

<div class="task-container">
    <a class="task-preview-link" href="<?= Url::to(['task/one', 'id' => $model->id]) ?>">
        <div class="task-preview">
            <div class="task-preview-header"><h4><?= $model->name ?></h4></div>
            <div class="task-preview-content"><?= $model->description ?></div>
            <div class="task-preview-user"><b><?= $model->responsible->login ?></b></div>
        </div>
    </a>
</div>