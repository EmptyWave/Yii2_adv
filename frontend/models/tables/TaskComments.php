<?php

namespace frontend\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "task_comments".
 *
 * @property int $id
 * @property string $content
 * @property int $task_id
 * @property int $user_id
 *
 * @property Task $task
 * @property Users $user
 */
class TaskComments extends \common\models\tables\TaskComments
{

}
