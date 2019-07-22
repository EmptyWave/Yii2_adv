<?php


namespace backend\components;


use common\models\Task;

interface TaskService
{
    /**
     * @param Task $task
     * @return bool
     */
    public function save(Task &$task): bool;

    /**
     * @param Task $task
     * @return bool
     */
    public function update(Task $task): bool;

    /**
     * @param $id
     * @return bool
     */
    public function getTask($id): ?Task;
}