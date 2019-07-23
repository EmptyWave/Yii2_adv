<?php


namespace frontend\components;


use frontend\models\tables\Task;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->setLanguageSettings();
        $this->attachEventsHandlers();
    }

    private function setLanguageSettings(){
        if($lang = \Yii::$app->session->get('lang')){
            \Yii::$app->language = $lang;
        }
    }

    private function attachEventsHandlers()
    {
        Event::on(Task::class, Task::EVENT_AFTER_INSERT, function ($event) {
            /** @var Task $task */
            $task = $event->sender;
            $user = $task->responsible;

            $body = "New task {$task->name}.
            link: http://yii2.uni.local/task/one?id={$task->id}";

            \Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom('admin@teest.ru')
                ->setSubject('New task')
                ->setTextBody($body)
                ->send();
        });
    }
}