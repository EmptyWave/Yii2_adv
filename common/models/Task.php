<?php
declare(strict_types=1);

namespace common\models;

use backend\components\SaveTaskEventInterface;
use frontend\validators\StatusValidate;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

class Task extends Model implements SaveTaskEventInterface
{
    private $title;
    private $description;
    private $author;

    private $id;

    /** @var integer */
    private $responsible;
    private $status;

    const EVENT_SAVE='task_save';

    /**
     * Task constructor.
     * @param $title
     * @param $description
     * @param $author
     * @param $responsible
     * @param $status
     */
    public function __construct(string $title, string $description, int $author, int $responsible, int $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->responsible = $responsible;
        $this->status = $status;
    }

    public static function creatEmptyTask(): self
    {
        return new self('', '', 0, 0, 0);
    }

    public function event_save(){
        \Yii::getLogger()->log('event object save in class',Logger::LEVEL_WARNING);
    }

    /**
     * @return mixed
     */
    public function getId():?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param array $parmas
     * @return Task
     */
    public static function fromRequestParams(array $params): self
    {
        $task= new self(
            ArrayHelper::getValue($params, 'title'),
            ArrayHelper::getValue($params, 'description'),
            (int)ArrayHelper::getValue($params, 'author'),
            (int)ArrayHelper::getValue($params, 'responsible'),
            (int)ArrayHelper::getValue($params, 'status')
        );


        return $task;
    }

    public static function fromDb(array $params): self
    {
        $task= new self(
            ArrayHelper::getValue($params, 'name'),
            ArrayHelper::getValue($params, 'description'),
            (int)ArrayHelper::getValue($params, 'creator_id'),
            (int)ArrayHelper::getValue($params, 'responsible_id'),
            (int)ArrayHelper::getValue($params, 'status_id')
        );
        $task->setId((int)ArrayHelper::getValue($params,'id'));
        return $task;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 10],
            [['status'], StatusValidate::class],
            [['author', 'responsible'], 'safe']
        ];
    }

    public function statusValidate($attribute, $params)
    {
        if (!in_array($this->$attribute, ['В работе', 'Закрыта'])) {
            $this->addError($attribute, 'Неверный статус');
        }
    }


    public function fields()
    {
        return [
            'header' => 'title',
            'description'
        ];
    }

    public static function getMonths()
    {
        return [
            'all' => 'Все месяцы',
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
    }
}