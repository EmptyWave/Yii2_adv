<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 *
 * @property Task[] $tasks
 */
class TaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

  public function getTasks()
  {
    return $this->hasMany(Task::className(), ['status_id' => 'id']);
  }

  public static function getStatusList()
  {
    return static::find()
      ->select(['title'])
      ->indexBy('id')
      ->column();
  }
}
