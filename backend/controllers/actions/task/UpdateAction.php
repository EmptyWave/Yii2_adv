<?php


namespace backend\controllers\actions\task;


use backend\components\TaskService;
use common\models\Task;
use common\models\TaskStatuses;
use common\models\User;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class UpdateAction extends Action
{
    /** @var TaskService */
    private $service;

    public function __construct($id, $controller, TaskService $service, $config = [])
    {
        $this->service=$service;
        parent::__construct($id, $controller, $config);
    }

    public function run($id)
    {
        $task=$this->service->getTask((int)$id);
        if(!$task){
            throw new HttpException(404,'Task not found');
        }

        if (\Yii::$app->request->isPost) {
            $task = Task::fromRequestParams(\Yii::$app->request->post('Task', []));
            $task->setId($id);

            if ($this->service->update($task)) {
                return $this->controller->redirect(['/']);
            }
        }

        $users = \Yii::$container->get(User::class)::find()->andWhere(['status' => User::STATUS_ACTIVE])->asArray()->all();

        $userList = ArrayHelper::map($users, 'id', 'username');

        $taskStatuse = TaskStatuses::STATUSES;

        return $this->controller->render('update', ['model' => $task,
            'userList' => $userList,
            'taskStatuses' => $taskStatuse]);

    }
}