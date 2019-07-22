<?php


namespace common\models;


use phpDocumentor\Reflection\Types\Self_;

class TaskStatuses
{
    public const STATUS_CREATED=0;
    public const STATUS_INWORK=1;
    public const STATUS_COMPLETED=2;

    public const STATUSES=[
        self::STATUS_CREATED=>'Создан',
        self::STATUS_INWORK=>'В работе',
        self::STATUS_COMPLETED=>'Звершен'
    ];
}