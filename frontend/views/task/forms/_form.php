<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="task-form">

  <h1 class="task-form__header"><?= Html::encode($this->title) ?></h1>

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  <div class="form-group row">
    <div class="col-lg-6">
  <?= $form->field($model, 'creator_id')->dropDownList($usersList) ?>
    </div>
    <div class="col-lg-6">
  <?= $form->field($model, 'responsible_id')->dropDownList($usersList) ?>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-lg-6">
  <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>
    </div>
    <div class="col-lg-6">
  <?= $form->field($model, 'status_id')->dropDownList($statusList) ?>
    </div>
  </div>

  <?= $form->field($model, 'description')->textarea(['rows' => '6', 'maxlength' => false]) ?>

  <div class="form-group">
    <?= Html::submitButton(Yii::t('app','save'), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
