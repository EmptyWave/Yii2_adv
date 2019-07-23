<?php
namespace frontend\models\forms;
class TaskAttachmentsAddForm extends \yii\base\Model
{
    public $taskId;
    /** @var  \yii\web\UploadedFile */
    public $attachment;

    private $filename;
    private $filepath;

    private $originalDir = '@img/tasks';
    private $copiesDir = '@img/tasks/small';


    public function rules()
    {
        return [
            [['taskId', 'attachment'], 'required'],
            ['taskId', 'integer'],
            ['attachment', 'file', 'extensions' => ['jpg', 'png']]
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $this->saveUploadedFile();
            $this->createMinCopy();
            return $this->saveData();
        }
        return false;
    }

    private function saveUploadedFile()
    {
        $randomString = \Yii::$app->security->generateRandomString();
        $this->filename = $randomString . "." . $this->attachment->getExtension();
        $this->filepath = \Yii::getAlias("{$this->originalDir}/{$this->filename}");
        $this->attachment->saveAs(
            $this->filepath
        );

    }

    private function createMinCopy()
    {
        \yii\imagine\Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->copiesDir}/{$this->filename}"));
    }

    private function saveData()
    {
        $model = new \frontend\models\tables\TaskAttachments([
            'task_id' => $this->taskId,
            'path' => $this->filename
        ]);
        return $model->save();
    }

}