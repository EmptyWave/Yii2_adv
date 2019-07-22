<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\tables\Users;

/* @var $this yii\web\View */
/* @var $model frontend\models\tables\Task */
/* @var $hide frontend\controllers\AdminTaskController */
/* @var $creatorId frontend\controllers\AdminTaskController */
/* @var $responsibleId frontend\controllers\AdminTaskController */
/* @var $statusId frontend\controllers\AdminTaskController */

$this->title = $model->name;
if (!$hide) { //убираем дублирование хлебных крошек, в случае использования данной метки
    $this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}

\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$hide): ?> <!-- убираем лишние кнопки, в случае использования данной метки -->
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            //'creator_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'creator_id (создатель)',
                'value' => $creatorId,
                'attribute' => 'creator_id'
            ],
            //'responsible_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'responsible_id (ответственный)',
                'value' => $responsibleId,
                'attribute' => 'responsible_id'
            ],
            'deadline',
//            'status_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'status_id (статус)',
                'value' => $statusId,
                'attribute' => 'status_id'
            ],
        ],
    ]) ?>

</div>
