<?php

namespace frontend\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $regDate
 */
class Users extends \common\models\tables\Users
{

}
