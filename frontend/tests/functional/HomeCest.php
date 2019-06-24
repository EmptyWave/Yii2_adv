<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class HomeCest
{

  public function _fixtures()
  {
    return [
      'user' => [
        'class' => UserFixture::className(),
        'dataFile' => codecept_data_dir() . 'login_data.php',
      ],
    ];
  }

  public function checkOpen(FunctionalTester $I)
  {
    //$I->amLoggedInAs(1);
    $I->amOnPage(\Yii::$app->homeUrl);
    $I->see('Logout (erau)', 'form button[type=submit]');
    $I->seeLink('About');
    $I->click('About');
    $I->see('This is the About page.');
  }
}