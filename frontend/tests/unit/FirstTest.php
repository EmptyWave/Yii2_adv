<?php namespace frontend\tests;

use frontend\models\SignupForm;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $model = new SignupForm();
        $model->username = 'qwerty';
        $model->email = 'email@email.ru';
        $model->password = 'sdfsdf';

        $this->tester->assertEquals($model->username, 'qwerty', 'Проверка имени пользователя');
        expect('Проверка валидности', $model->validate())->true();

    }
}