<?php


namespace backend\share;


use common\models\Task;

interface RepositoryTask
{
    public function create(Task &$task): bool;

    public function update(Task $task): bool;

    public function findById(int $id): ?Task;
}