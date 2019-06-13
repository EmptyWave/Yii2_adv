<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;
use frontend\models\SignupForm;
use common\models\LoginForm;
use frontend\models\ContactForm;
use common\models\Task;
use frontend\models\filters\TasksFilter;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            'actions' => ['index','logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
          [
            'actions' => ['login','signup'],
            'allow' => true,
            'roles' => ['?'],
          ],
          [
            'actions' => ['about','lang'],
            'allow' => true,
            'roles' => ['@','?'],
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
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  public function actionIndex()
  {
    $searchModel = new TasksFilter();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $monthList = Task::getCreateMonthList();

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'monthList' => $monthList,
    ]);
  }

  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    } else {

      $model->password = '';
      return $this->render('login', [
        'model' => $model,
      ]);

    }

  }

  public function actionSignup()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new SignupForm();
    $post = Yii::$app->request->post();
    if ($post){
      if ($model->load($post) && $model->signup()) {
        Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
        return $this->goHome();
      }
    }

    return $this->render('signup', [
      'model' => $model,
    ]);
  }

  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  public function actionAbout()
  {
    return $this->render('about');
  }

  public function actionLang($lang)
  {
    Yii::$app->session->set('lang', $lang);
    $this->redirect(Yii::$app->request->referrer);
  }
}
