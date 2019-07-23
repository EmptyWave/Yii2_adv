<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
$TaskEdit=Yii::$app->user->can('TaskEdit');
$TaskDelete=Yii::$app->user->can('TaskDelete');
?>

<div class="task-container">

<?= \frontend\widgets\TaskView::widget([
  'model' => $model,
  'link' => false,
]); ?>

  <div class="task-btn-box">
    <?= Yii::$app->user->can('TaskEdit') ? Html::a(Yii::t('app','edit_task'), ['edit', 'id' => $model->id], [
      'class' => 'btn btn-primary task-btn'
    ]) : '' ?>
    <?= Yii::$app->user->can('TaskDelete') ? Html::a(Yii::t('app','delete_task'), ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger task-btn',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) : '' ?>
  </div>
</div>




<div class="task-attachments-container">
  <div class="task-attachments-list">
    <?php foreach ($model->taskAttachments as $file):?>
      <a href="/img/<?=$file->path?>">
        <img src="/img/min/<?=$file->path?>" alt="<?=explode('.',$file->path)[0]?>">
      </a>
    <?php endforeach;?>
  </div>

  <?php $form = ActiveForm::begin([
    'action' => Url::to(['task/add-attachment']),
    'fieldConfig' => [
      'options' => [
        'offset' => '',
        'tag' => false,
      ],
    ],
  ]); ?>
  <div class="task-attachments-form">
    <?= Html::submitButton(Yii::t('app','add_files'), ['class' => 'btn btn-success']) ?>
    <?= $form->field($addAttachmentsForm, 'attachments[]')->fileInput(['multiple' => true])->label(false) ?>
    <?= $form->field($addAttachmentsForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false) ?>
  </div>
  <?php ActiveForm::end(); ?>

</div>

<div class="task-comments-container">
  <?php foreach ($model->taskComments as $comment):?>
    <?= \frontend\widgets\CommentView::widget([
      'taskComment' => $comment
    ]); ?>
  <?php endforeach;?>
</div>
<div class="task-comments-form">
  <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>
  <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false) ?>
  <?= $form->field($taskCommentForm, 'creator_id')->hiddenInput(['value' => $userId])->label(false) ?>
  <?= $form->field($taskCommentForm, 'comment')->textarea(['rows' => '3', 'maxlength' => 255]) ?>
  <div class="form-group">
    <?= Html::submitButton(Yii::t('app','save'), ['class' => 'btn btn-success']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
