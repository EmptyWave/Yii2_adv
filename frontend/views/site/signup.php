<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
  <div class="col-lg-offset-4 col-lg-8">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to signup:</p>
  </div>

  <?php $form = ActiveForm::begin([
    'id' => 'form-signup',
    'layout' => 'horizontal',
    'fieldConfig' => [
      'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-4 control-label'],
    ],
  ]); ?>

  <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

  <?= $form->field($model, 'password')->passwordInput() ?>

  <?= $form->field($model, 'email')->input('email') ?>

  <?= $form->field($model, 'phone')->input('phone') ?>

  <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
      <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>