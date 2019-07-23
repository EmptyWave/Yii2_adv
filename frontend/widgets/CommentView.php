<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 24.05.2019
 * Time: 21:58
 */

namespace frontend\widgets;


use common\models\Task;
use common\models\TaskComments;
use \yii\base\Widget;

class CommentView extends Widget
{
  public $taskComment;

  public function run(){
    if (isset($this->taskComment)){
      return $this->render('commentView', [
        'taskComment' => $this->taskComment,
      ]);
    }
    throw new \Exception('Wrong object');
  }
}