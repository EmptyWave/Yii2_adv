<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 24.05.2019
 * Time: 19:11
 */

namespace app\components;


use common\models\Task;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\Url;

class Bootstrap extends Component implements BootstrapInterface
{
  public function bootstrap($app){
    $this->setSiteLanguage();
    $this->attachEventsHandlers();
  }

  private function setSiteLanguage(){
    if ($lang = \Yii::$app->session->get('lang')){
      \Yii::$app->language = $lang;
    }
  }

  private function attachEventsHandlers(){
    Event::on(Task::class, Task::EVENT_AFTER_INSERT, function ($event) {
      $task = $event->sender;
      $user = $task->responsible;

      $body = "Назначена новая задача ($task->name).
        Ссылка на задачу - " . Url::toRoute(['task/view', 'id' => $task->id], true);

      \Yii::$app->mailer->compose()
        ->setTo($user->email)
        ->setFrom('admin@gmail.com')
        ->setSubject("Новая задача - " . $task->name)
        ->setTextBody($body)
        ->send();
    });

    Event::on(Task::class, Task::EVENT_BEFORE_DELETE, function ($event) {
      $task = $event->sender;
      $user = $task->responsible;

      $body = "Задача - $task->name, отменена.";

      \Yii::$app->mailer->compose()
        ->setTo($user->email)
        ->setFrom('admin@gmail.com')
        ->setSubject("Задача отменена - " . $task->name)
        ->setTextBody($body)
        ->send();
    });
  }
}