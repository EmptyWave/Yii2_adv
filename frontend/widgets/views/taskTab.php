<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\User;
?>

<a href="<?=Url::to(['task/view', 'id' => $model->id])?>"
   class="task-view__link <?= $link?'':'disabled w60' ?>">
  <div class="task-view <?=$link?'task-view__hover':''?>">
    <div class="task-view__row">
      <h4><?= $model->name?></h4>
      <p><?= Yii::t('app','status').': '.$model->status->title?></p>
    </div>
    <div class="task-view__row">
      <div class="task-view__party">
        <p><?= Yii::t('app','creator').': '.$model->creator->username?></p>
        <p><?= Yii::t('app','responsible').': '.$model->responsible->username?></p>
      </div>
      <p><?= Yii::t('app','deadline').': '.$model->deadline?></p>
    </div>
    <p class="<?= $link?'task-view__description__cut':'' ?>"><?= Yii::t('app','description').': '.$model->description?></p>
      <div class="task-view__row">
          <p><?= Yii::t('app','created').': '.$model->createdDate?></p>
          <p><?= Yii::t('app','modified').': '.$model->modified?></p>
      </div>
  </div>
</a>