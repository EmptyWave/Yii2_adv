<?php


namespace common\components;


use frontend\models\tables\Task;
use yii\base\Component;

class TaskComponent extends Component
{
    public function create(Task &$model):bool{

        if(!$model->validate()){
            return false;
        }

        if(!$model->save(false)){
            return false;
        }

        return true;
    }
}