<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \frontend\models\tables\Users;

/* @var $this yii\web\View */
/* @var $model frontend\models\tables\Task */
/* @var $form yii\widgets\ActiveForm */

/* @var $usersList[] \app\controllers\AdminTaskController */
/* @var $statusesList[] \app\controllers\AdminTaskController */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    Выпадающий список пользователей-->
    <?= $form->field($model, 'author')->dropDownList($usersList); ?>

<!--    Выпадающий список пользователей-->
    <?= $form->field($model, 'responsible')->dropDownList($usersList); ?>

<!--    <?//= $form->field($model, 'deadline')->textInput(['type'=>'date']) ?>-->


    <?= $form->field($model, 'status')->dropDownList($statusesList) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
