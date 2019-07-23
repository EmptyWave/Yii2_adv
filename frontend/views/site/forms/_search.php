<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\filters\TasksFilter */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="task-search">

  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'layout' => 'horizontal',
    'class' => 'form-horizontal',
    'fieldConfig' => [
      'template' => "<div class=\"col-sm-4\"><div class=\"form-group\">\n{label}<div class=\"col-sm-7\">{input}</div></div></div>",
      'labelOptions' => ['class' => 'col-sm-5 control-label'],
      'options' => [
        'tag' => false,
      ],
    ],
  ]); ?>
  <div class="col-sm-1"></div>
  <?= $form
    ->field($model, 'responsible_id', ['inputOptions' => ['placeholder' => 'User ID - временно',]])
    ->textInput() ?>

  <?= $form->field($model, 'created')
    ->dropDownList($monthList, [
      'class' => 'form-control input-md',
      'prompt' => 'Select month'
    ]) ?>

  <div class="col-sm-3">
    <div class="form-group">
      <div class="col-md-12">
        <?= Html::submitButton(Yii::t('app','search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','reset'), ['site/index'], ['class' => 'btn btn-default']) ?>
      </div>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>
<!--'template' => " <div class=\"col-auto my-1\">{label}\n{input}</div>",-->