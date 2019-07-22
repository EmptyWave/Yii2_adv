<?php


namespace backend\controllers\actions;


use yii\base\Action;

class ProfileAction extends Action
{
    public $name;
    public function run(){

        return $this->controller->render('profile',
            ['user' => \Yii::$app->user->getIdentity(), 'name' => $this->name]);
    }

}