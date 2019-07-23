<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 26.05.2019
 * Time: 15:35
 */

namespace frontend\models;


use common\models\TaskAttachments;
use yii\base\Model;
use yii\imagine\Image;

class AddAttachmentsForm extends Model
{
  public $taskId;
  public $attachments = [];

  private $filesCount;
  private $fileName;
  private $filePath;
  private $fileDir = '@img';
  private $fileDirMin = '@img/min';

  public function rules()
  {
    return [
      [['taskId', 'attachments'], 'required'],
      ['taskId', 'integer'],
      ['attachments', 'file', 'extensions' => ['jpg','png'], 'maxFiles' => 5]
    ];
  }

  private function saveUpload(){
    foreach ($this->attachments as $file) {
      $filePath = \Yii::getAlias("$this->fileDir/{$file->name}");
      $file->saveAs($filePath);
      $this->filePath[] = $filePath;
    }
  }

  private function saveUploadMin(){
    for ($i = 0; $i < $this->filesCount; $i++){
      Image::thumbnail($this->filePath[$i], 200,150)
        ->save(\Yii::getAlias("{$this->fileDirMin}/{$this->fileName[$i]}"));
    }
  }

  private function saveFiles(){
    foreach ($this->fileName as $fileName){
      $model = new TaskAttachments([
        'task_id' => $this->taskId,
        'path' => $fileName
      ]);
      $model->save();
    }

  }

  public function save(){
    if ($this->validate()){
      $this->filesCount = count($this->attachments);
      foreach ($this->attachments as $file){
        $this->fileName[] = $file->name;
      }
      $this->saveUpload();
      $this->saveUploadMin();
      $this->saveFiles();
      return true;
    }
    return false;
  }
}