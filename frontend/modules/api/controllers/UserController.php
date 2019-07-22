<?php


namespace frontend\modules\api\controllers;


use common\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class
        ];

        return $behaviors;
    }
}