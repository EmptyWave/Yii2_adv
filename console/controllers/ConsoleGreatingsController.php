<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 13.06.2019
 * Time: 13:12
 */

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

class ConsoleGreatingsController extends Controller
{
  /**
   * Hello console func
   */
  public function actionIndex($message = 'hello world')
  {
    echo $message . "\n";

    return ExitCode::OK;
  }

}