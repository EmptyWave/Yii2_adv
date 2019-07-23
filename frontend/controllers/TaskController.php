<?php

namespace frontend\controllers;

use frontend\models\filters\TasksFilter;
use frontend\models\forms\TaskAttachmentsAddForm;
use frontend\models\tables\TaskComments;
use frontend\models\tables\TaskStatuses;
use frontend\models\tables\Users;
use frontend\models\tables\Task;
use Yii;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    //public $layout = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
//                Выбор только конкретных action, если не указывать, то для всех:
//                'only' => ['one'],
                'rules' => [
                    [
//                        Подтверждение конкретных action:
//                        'actions' => ['one'],
//                        true - разрешить доступ, false - запретить доступ:
                        'allow' => true,
//                        роли, '@' - для авторизованных пользователей, '?' - для неавторизованных пользователей, гостей:
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        //2. На главной странице сделать возможность фильтровать задачи по месяцам
        $months = \frontend\models\Task::getMonths();
        $request = Yii::$app->request;
        $month = $request->post('months') ?: 'all';

//        "SELECT * FROM task WHERE MONTH(deadline) = {$month}";

        if($month == 'all') {
            $dataProvider = new ActiveDataProvider([
                'query' => Task::find(),
                'pagination' => [
                    'pageSize' => 12
                ],
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Task::find()
                    ->where("MONTH(deadline) = {$month}"),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
        }


        //Настройки сортировки по умолчанию
        $dataProvider->sort->attributes['update_time'] = [
            'asc' => ['update_time' => SORT_ASC],
            'desc' => ['update_time' => SORT_DESC],
            //Переименовываем:
            'label' => 'By update date',
        ];
        //Сортировка по умолчанию:
        $dataProvider->sort->defaultOrder['update_time'] = SORT_ASC;

        //3. На главной странице кэшировать результат выполнения запроса тасков(по месяцам)
//        \Yii::$app->db->cache(function() use ($dataProvider){
//            return $dataProvider->prepare();
//        });

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'months' => $months,
            'month' => $month,
        ]);
    }

    public function actionOne($id)
    {
        $model = Task::findOne($id);

        return $this->render('one', [
            'model' => $model,
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'userId' => \Yii::$app->user->id, //авторизованный пользователь
        ]);
    }

    public function actionSave($id){
        if ($model = Task::findOne($id)) {
            $model->load(Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменения сохранены");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', "Комментарий добавлен!");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен!");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить Файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}