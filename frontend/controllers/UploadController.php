<?php


namespace app\controllers;


use frontend\models\Task;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{

    public function actionIndex()
    {
        $model = new Task();
        if($model->load(\Yii::$app->request->post())){
            $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');
            $model->upload();
        }
        return $this->render("index", ['model' => $model]);
    }

    public function actionInter()
    {
        \Yii::$app->language = 'en';
        echo \Yii::t("app", "error", ['number' => 404]);
        exit;
    }
}