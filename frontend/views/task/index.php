<?php
/** @var $dataProvider \frontend\commands\TaskController*/
/** @var $month \frontend\commands\TaskController */
/** @var $months \frontend\commands\TaskController */

//Сортировка:
use frontend\assets\TaskAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

TaskAsset::register($this);

echo $dataProvider->sort->link('deadline') . ' / ';
echo $dataProvider->sort->link('create_time') . ' / ';
echo $dataProvider->sort->link('update_time');

?>

<?php $form = ActiveForm::begin(); ?>
    <div>
        <div>Фильтр по месяцам:</div>
        <div class="btn">
            <?= Html::dropDownList('months', $month, $months) ?>
        </div>
        <div>
            <?= Html::submitButton('Выбрать месяц', ['class' => 'btn']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php
//Пример кэширование вьюхи:
//$request = Yii::$app->request;
//$get = $request->get('sort');

//$key = 'dataProviderTask';
//if ($this->beginCache($key, [
//    'duration' => 5,
//    //'variation' => $get,
//])) {

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model) {
        return \frontend\widgets\TaskPreview::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]);
//    $this->endCache();
//}
