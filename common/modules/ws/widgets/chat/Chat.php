<?php


namespace common\modules\ws\widgets\chat;


use yii\base\Widget;

class Chat extends Widget
{

    public $directoryAsset;

    public function init()
    {
        if(!$this->directoryAsset){
            throw new \Exception('need param directoryAsset');
        }
        parent::init();
    }

    public function run()
    {
        return $this->render('index',['directoryAsset'=>$this->directoryAsset]);
    }
}