<?php

namespace frontend\models\tables;

use frontend\models\tables\TaskStatuses;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 *
 * @property Test $status
 * @property Users $responsible
 * @property TaskComments[] $taskComments
 * @property TaskAttachments[] $taskAttachments
 */
class Task extends \common\models\tables\Task
{

}
