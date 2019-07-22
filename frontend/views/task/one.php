<?php

use frontend\assets\TaskAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/**@var \frontend\models\tables\Task $model */
/**@var \frontend\models\tables\Users[] $usersList */
/**@var \frontend\models\tables\TaskStatuses[] $statusesList */
/**@var \yii\web\User $userId */
/**@var \frontend\models\tables\TaskComments $taskCommentForm */
/**@var \frontend\models\forms\TaskAttachmentsAddForm $taskAttachmentForm */

//TaskAsset::register($this);
?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <!--        <? //= \yii\jui\DatePicker::widget([
        //            'model' => $model,
        //            'attribute' => 'deadline'
        //        ]); ?>-->
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'status_id')
                    ->dropDownList($statusesList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'responsible_id')
                    ->dropDownList($usersList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'deadline')
//                    ->textInput(['type' => 'date'])
                    ->widget(\yii\jui\DatePicker::class,
                        ['dateFormat' => 'yyyy-MM-dd',
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Дата в формате yyyy-MM-dd',
                                'autocomplete' => 'off',
                            ]]);
                ?>
            </div>
        </div>
        <?= $form->field($model, 'description')->textInput(); ?>

        <?= "<small><i>Create time:  {$model->create_time}  
                    Update time:   {$model->update_time}  </i></small>" ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="attachments">
        <h3><?= Yii::t("view", "task_attachments") ?></h3>
        <?php $form = ActiveForm::begin([
            "action" => Url::to(['task/add-attachment']),
            'options' => ['class' => 'form-inline']
        ]); ?>
        <!-- скрытое поле-->
        <?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false); ?>
        <?= $form->field($taskAttachmentForm, 'attachment')->fileInput() ?>
        <?= \yii\helpers\Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
        <?php ActiveForm::end() ?>
        <hr>
        <div class="attachmetns-history">
            <?php foreach ($model->taskAttachments as $file): ?>
                <a href="/img/tasks/<?= $file->path ?>" style="display: inline-block; padding: 5px">
                    <img src="/img/tasks/small/<?= $file->path ?>" alt="">
                    <?= "<figcaption><small><i>{$file->create_time}</i></small></figcaption>" ?>
                </a>
            <?php endforeach; ?>
        </div>
        <h3><?= Yii::t("view", "task_comments") ?></h3>
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>
        <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
        <!-- скрытое поле-->
        <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
        <!-- скрытое поле-->
        <?= $form->field($taskCommentForm, 'content')->textarea() ?>
        <?= \yii\helpers\Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
        <?php ActiveForm::end() ?>
        <hr>
        <div class="comment-history">
            <?php foreach ($model->taskComments as $comment): ?>
                <p>
                    <strong><?= $comment->user->login ?></strong>
                    <?= "{$comment->content} 
                    <br><small><i>Create time:  {$comment->create_time}  
                    Update time:   {$comment->update_time}  </i></small>" ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
</div>