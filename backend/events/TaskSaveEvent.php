<?php


namespace backend\events;

use common\models\Task;
use Symfony\Contracts\EventDispatcher\Event;

class TaskSaveEvent extends Event
{
    /** @var Task */
    private $task;

    /**
     * TaskSaveEvent constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTask():Task{
        return $this->task;
    }


}