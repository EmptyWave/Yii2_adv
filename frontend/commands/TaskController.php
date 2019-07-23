<?php
namespace frontend\commands;

use frontend\models\tables\Task;
use frontend\models\tables\Users;
use yii\console\Controller;
use yii\helpers\Console;

class TaskController extends Controller
{
    public $message = 'hello';

    /**
     * Deadline expiration alert for users.
     */
    public function actionDeadline()
    {
        $i =1;
        $g = Task::deadlineSoonCount();
        Console::startProgress($i, $g);

        /** @var Task[] $tasks */
        $tasks = Task::deadlineSoon();

        foreach ($tasks as $task){
            \Yii::$app->mailer->compose()
                ->setTo($task->responsible->email)
                ->setSubject("deadline")
                ->setTextBody("Истекает срок годности")
                ->send();
            Console::updateProgress($i, $g);
            $i++;
        }
        Console::endProgress();
        echo 'end';
    }


    /**
     * Test
     */
    public function actionTest($id)
    {
        if($user = Users::findOne($id)){
            $this->stdout("{$this->message}, {$user->login}");
            return self::EXIT_CODE_NORMAL;
        }
        return self::EXIT_CODE_ERROR;
    }

    public function actionIndex()
    {
        echo "start";
        Console::startProgress(1, 100);
        for($i = 1; $i < 100; $i++){
            sleep(1);
            Console::updateProgress($i, 100);
        }
        Console::endProgress();
        echo "end";
    }


    public function options($actonId)
    {
        return [
            'message'
        ];
    }

    public function optionAliases()
    {
        return [
            'm' => 'message'
        ];
    }

}