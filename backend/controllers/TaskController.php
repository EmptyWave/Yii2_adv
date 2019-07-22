<?php


namespace backend\controllers;


use backend\controllers\actions\task\CreateAction;
use backend\controllers\actions\task\UpdateAction;

class TaskController extends \backend\share\Controller
{
    public function actions()
    {
        return [
            'create'=>CreateAction::class,
            'update'=>UpdateAction::class
        ];
    }
}