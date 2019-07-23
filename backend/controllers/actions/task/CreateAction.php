<?php


namespace backend\controllers\actions\task;


use backend\components\TaskService;
use common\models\Task;
use common\models\TaskStatuses;
use common\models\User;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

class CreateAction extends Action
{
    /** @var TaskService */
    private $service;

    public function __construct($id, $controller, Task $service, $config = [])
    {
        $this->service=$service;
        parent::__construct($id, $controller, $config);
    }

    public function run()
    {
        if (\Yii::$app->request->isPost) {
            $task = Task::fromRequestParams(\Yii::$app->request->post('Task', []));

            if ($this->service->save($task)) {
                return $this->controller->redirect(['/']);
            }
        } else {
            $task = Task::creatEmptyTask();
        }

        $users = \Yii::$container->get(IdentityInterface::class)::find()->andWhere(['status' => User::STATUS_ACTIVE])->asArray()->all();

        $userList = ArrayHelper::map($users, 'id', 'username');

        $taskStatuse = TaskStatuses::STATUSES;

        return $this->controller->render('create', ['model' => $task,
            'userList' => $userList,
            'taskStatuses' => $taskStatuse]);

    }
}