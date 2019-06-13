<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 14.04.2019
 * Time: 12:22
 */

namespace app\models;

use yii\base\Model;

class Task extends Model
{
  public $title;
  public $description;
  public $author;
  public $responsible;
  public $status;

  public function rules(){
    return  [
      [['description','author'],'required'],
      ['title','string','max'=>10],
      ['status','statusValidate'],
      [['responsible'],'safe']
    ];
  }
  public function statusValidate($attribute, $params){
    if (!in_array($this->$attribute, ['В работе','Закрыт'])){
      $this->addError('Wrong status');
    }
  }

}