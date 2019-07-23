<?php


namespace backend\components;


use backend\share\RepositoryTask;
use common\models\Task;
use yii\db\Connection;
use yii\db\Exception;
use yii\db\Query;

class TaskRepositoryMysql implements RepositoryTask
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection=$connection;
    }

    public function create(Task &$task): bool
    {
        $i=$this->connection->createCommand()->insert('task',[
            'name'=>$task->getTitle(),
            'description'=>$task->getDescription(),
            'creator_id'=>$task->getAuthor(),
            'responsible_id'=>$task->getResponsible(),
            'deadline'=>date('Y-m-d'),
            'status_id'=>$task->getStatus(),
            'create_time'=>date('Y-m-d H:i:s'),
            'update_time'=>date('Y-m-d H:i:s')
        ])->execute();

        $task->id=$this->connection->getLastInsertID();

        return $i==1?true:false;
    }

    public function findById(int $id): ?Task
    {
        $query=new Query();
        $data=$query->from('task')
            ->andWhere(['id'=>$id])
            ->one($this->connection);
        if(!$data){
            return null;
        }

        return Task::fromDb($data);

    }

    public function update(Task $task): bool
    {
        try {
            $this->connection->createCommand()->update('task', [
                'name' => $task->getTitle(),
                'description' => $task->getDescription(),
                'creator_id' => $task->getAuthor(),
                'responsible_id' => $task->getResponsible(),
                'deadline' => date('Y-m-d'),
                'status_id' => $task->getStatus(),
                'create_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s')
            ], ['id' => $task->getId()])->execute();
        }catch (Exception $e){
            return false;
        }

        return true;
    }
}