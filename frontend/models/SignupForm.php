<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 21.04.2019
 * Time: 2:07
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
  public $username;
  public $password;
  public $email;
  public $phone;

    private $_user = false;

  public function rules()
  {
    return [
      [['username', 'password', 'email', 'phone'], 'required'],

      ['username', 'trim'],
      ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
      ['username', 'string', 'min' => 2, 'max' => 255],

      ['email', 'trim'],
      ['email', 'email'],
      ['email', 'string', 'max' => 255],
      ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

      ['password', 'string', 'min' => 6],

      ['phone', 'string', 'length' => [11,11]],
    ];
  }

  public function signup(){
      if (!$this->validate()) {
        return false;
      }

    $user = new User();
    $user->username = $this->username;
    $user->email = $this->email;
    $user->phone = $this->phone;
    $user->status = User::STATUS_ACTIVE;
    $user->setPassword($this->password);
    $user->generateAuthKey();
    $user->generateEmailVerificationToken();
    return $user->save() && $this->sendEmail($user);


  }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
            return $this->_user;
        }
        return false;
    }

  /**
   * Sends confirmation email to user
   * @param User $user user model to with email should be send
   * @return bool whether the email was sent
   */
  protected function sendEmail($user)
  {
    return Yii::$app
      ->mailer
      ->compose(
        ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
        ['user' => $user]
      )
      ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
      ->setTo($this->email)
      ->setSubject('Account registration at ' . Yii::$app->name)
      ->send();
  }

}