<?php
/**
 * Created by PhpStorm.
 * User: 23rad
 * Date: 18.04.2019
 * Time: 17:03
 */

namespace frontend\validators;

use frontend\models\tables\TaskStatuses;
use yii\validators\Validator;

class StatusValidate extends Validator
{
//    public $status;

    public function validateAttribute($model, $attribute)
    {
//        $status = $this->status;

        $value = $model->$attribute;
        if(!in_array($value, array_keys(\common\models\TaskStatuses::STATUSES))){
            $this->addError($model, $attribute, 'Неверный статус');

//            return;
        }
    }
}