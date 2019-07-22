<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    /**
     * @dataProvider pageProvider
     */
    public function testPageH1(FunctionalTester $I, Example $data){
        $I->amLoggedInAs(1);

        $I->amOnPage($data['url']);

        $I->see($data['h1'], 'h1');
    }

    /**
     * @return array
     */
    protected function pageProvider() // alternatively, if you want the function to be public, be sure to prefix it with `_`
    {
        return [
            ['url'=>"site/profile", 'h1'=>"erau"],
            ['url'=>"/", 'h1'=>"My Yii Application"],
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField(['name' => 'LoginForm[username]'], 'erau');
        $I->fillField(['id' => 'loginform-password'], 'password_0');
        $I->click('login-button');

//        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->seeLink('Sign out');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
