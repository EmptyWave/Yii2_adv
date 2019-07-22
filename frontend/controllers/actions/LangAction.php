<?php


namespace frontend\controllers\actions;

use Yii;
use yii\base\Action;

class LangAction extends Action
{

    public function run($lang)
    {
        Yii::$app->session->set('lang', $lang);
        $this->controller->redirect(Yii::$app->request->referrer);
    }
}