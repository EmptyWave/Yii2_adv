<?php

namespace common\models\tables;

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
class Users extends \yii\db\ActiveRecord
{
    const SCENARIO_AUTH = 'auth';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            //[['regDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'regDate' => 'Reg Date',
        ];
    }

    public function fields()
    {
        if ($this->scenario == static::SCENARIO_AUTH) {
            return [
                'id',
                'username' => 'login',
                'password'];
        }
        return parent::fields();
    }

    public static function getUsersList()
    {
        return static::find()
            ->select(['login'])
            ->indexBy('id')
            ->column();
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
