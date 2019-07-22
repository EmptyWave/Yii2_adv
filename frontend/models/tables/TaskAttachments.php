<?php

namespace frontend\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "task_attachments".
 *
 * @property int $id
 * @property int $task_id
 * @property string $path
 *
 * @property Task $task
 */
class TaskAttachments extends \common\models\tables\TaskAttachments
{

}
