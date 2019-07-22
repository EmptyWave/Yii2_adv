<?php


namespace frontend\components;


use yii\helpers\ArrayHelper;

class SearchService implements Search
{
    private $repository;

    public function __construct($pero)
    {
        $this->repository = $pero;
    }

    public function find($name)/*:?string*/ {

        $s = $this->repository->find($name);

        return mb_strtoupper($s, 'utf-8');
    }
}