<?php


namespace backend\components;


use backend\share\RepositoryTask;

class Task implements TaskService
{

    /** @var RepositoryTask */
    private $repository;

    public function __construct(RepositoryTask $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \common\models\Task $task
     * @return bool
     */
    public function save(\common\models\Task &$task): bool
    {
        if (!$task->validate()) {
            return false;
        }

        if (!$this->repository->create($task)) {
            return false;
        }

        return true;
    }

    /**
     * @param \common\models\Task $task
     * @return bool
     */
    public function update(\common\models\Task $task): bool
    {
        if (!$task->validate()) {
            return false;
        }

        if (!$this->repository->update($task)) {
            return false;
        }

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function getTask( $id): ?\common\models\Task
    {
        $task=$this->repository->findById($id);
        return $task;
    }
}