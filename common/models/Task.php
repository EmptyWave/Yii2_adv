<?php

namespace common\models;

use frontend\validators\StatusValidate;
use yii\base\Model;

class Task extends Model
{
    public $title;
    public $description;
    public $author;
    public $responsible;
    public $status;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 10],
            [['status'], StatusValidate::class],
            [['author', 'responsible'], 'safe']
        ];
    }

    public function statusValidate($attribute, $params)
    {
        if(!in_array($this->$attribute, ['В работе', 'Закрыта'])){
            $this->addError($attribute, 'Неверный статус');
        }
    }


    public function fields()
    {
        return [
            'header' => 'title',
            'description'
        ];
    }

    public static function getMonths(){
        return [
            'all' => 'Все месяцы',
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
    }
}