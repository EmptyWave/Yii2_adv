<?php

use frontend\models\tables\Users;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use \frontend\models\tables\Task;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            //Task::getCreatorId(), возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'creator_id (создатель)',
                'value' => Task::getCreatorId(),
                'attribute' => 'creator_id'
            ],
            //Task::getResponsibleId(), возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'responsible_id (ответственный)',
                'value' => Task::getResponsibleId(),
                'attribute' => 'responsible_id'
            ],
            'deadline',
//            Task::getStatusId(), возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'status_id (статус)',
                'value' => Task::getStatusId(),
                'attribute' => 'status_id'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

//    echo ListView::widget([
//        'dataProvider' => $dataProvider,
//        'itemView' => 'view',
//        'viewParams' => [
//            'hide' => true, //убираем хлебные крошки и лишние кнопки, в случае использования данной метки
//        ],
//    ]);

    ?>


</div>
