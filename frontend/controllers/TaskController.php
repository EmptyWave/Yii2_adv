<?php

namespace frontend\controllers;


use frontend\models\AddAttachmentsForm;
use common\models\TaskComments;
use common\models\TaskStatuses;
use common\models\Task;
use common\models\User;
use yii\caching\DbDependency;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use Yii;


class TaskController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            //'actions' => ['view'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  public function actionIndex()
  {

    return $this->render('index');

  }

  public function actionView()
  {
    $get = Yii::$app->request->get('id');

    if ($get) {

      $cache = Yii::$app->cache;
      $key = 'Task_' . $get;

      if (!$model = $cache->get($key)) {
        $dependency = new DbDependency();
        $dependency->sql = 'SELECT MAX(modified) FROM `task`';

        $model = $this->findModel($get);
        $cache->set($key, $model, 300, $dependency);
      }

      return $this->render('view', [
        'model' => $model,
        'addAttachmentsForm' => new AddAttachmentsForm(),
        'taskCommentForm' => new TaskComments(),
        'userId' => \Yii::$app->user->id,
      ]);
    }
    return $this->goHome();
  }

  public function actionCreate()
  {
    $model = new Task();
    $post = Yii::$app->request->post();

    if ($model->load($post) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    $usersList = User::getUserList();
    $statusList = TaskStatuses::getStatusList();

    return $this->render('create', [
      'model' => $model,
      'usersList' => $usersList,
      'statusList' => $statusList,
    ]);
  }

  public function actionEdit($id)
  {
    $model = $this->findModel($id);
    $post = Yii::$app->request->post();

    if ($post){
      if ($model->load($post) && $model->save()) {
        \Yii::$app->session->setFlash('success', "Changes saved");
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }


    $usersList = User::getUserList();
    $statusList = TaskStatuses::getStatusList();

    return $this->render('edit', [
      'model' => $model,
      'usersList' => $usersList,
      'statusList' => $statusList,
    ]);
  }

  public function actionAddAttachment()
  {
    $model = new AddAttachmentsForm();

    $model->load(Yii::$app->request->post());
    $model->attachments = UploadedFile::getInstances($model, 'attachments');
    if ($model->save()) {
      \Yii::$app->session->setFlash('success', "File uploaded successfully");
    } else {
      \Yii::$app->session->setFlash('success', "File not uploaded");
    }
    return $this->redirect(\Yii::$app->request->referrer);
  }

  public function actionAddComment()
  {
    $model = new TaskComments();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      \Yii::$app->session->setFlash('success', "Comment added");
    } else {
      \Yii::$app->session->setFlash('success', "Comment not added");
    }
    return $this->redirect(\Yii::$app->request->referrer);
  }

  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->goHome();
  }

  public function actionActive()
  {
    if (!Yii::$app->user->isGuest) {
      $id = Yii::$app->user->identity->getId();
      $dataProvider = new ActiveDataProvider([
        'query' => Task::find()
          ->where(['responsible_id' => $id])
      ]);
    }
    return $this->render('active', [
      'title' => 'Active Tasks',
      'dataProvider' => $dataProvider
    ]);
  }

  protected function findModel($id)
  {
    if (($model = Task::findOne($id)) !== null) {
      return $model;
    }

    return Null;
  }

}