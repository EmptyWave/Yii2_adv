<?php


namespace frontend\components;

use frontend\models\tables\Task;

class TaskComponent extends \common\components\TaskComponent
{
    public function create(Task &$model):bool{

        return parent::create($model);
    }
}