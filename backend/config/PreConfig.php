<?php


namespace backend\config;


use backend\components\SaveTaskEventInterface;
use backend\subscribers\SaveTaskSubscriber;
use common\models\Task;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;

class PreConfig implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {

        Event::on(SaveTaskEventInterface::class,SaveTaskEventInterface::TASK_SAVE,
            function($event){
                $task=$event->sender;

                \Yii::warning('event INTERFACE save '.$task->title);
            });

        Event::on(Task::class,Task::EVENT_SAVE,function (Event $event){
            $task=$event->sender;

            \Yii::warning('event CLASS save '.$task->title);
        });

/** @var EventDispatcherInterface $event_dispatcher */
        $event_dispatcher=\Yii::$container->get(EventDispatcherInterface::class);

        $subcriber= \Yii::$container->get(SaveTaskSubscriber::class);

        $event_dispatcher->addSubscriber($subcriber);

    }
}