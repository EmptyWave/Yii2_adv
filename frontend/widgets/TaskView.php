<?php

namespace frontend\widgets;

use \common\models\Task;
use \yii\base\Widget;

class TaskView extends Widget
{
  public $model;
  public $link=true;

  public function run(){
    if (is_a($this->model, Task::class)){
      return $this->render('taskTab', [
        'model' => $this->model,
        'link' => $this->link,
        ]);
    }
    throw new \Exception('Wrong object');
  }
}