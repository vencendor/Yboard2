<?php


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors",1);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

ob_start();

$config = require __DIR__ . '/../config/main_conf.php';
require(__DIR__ . '/../helpers.php');

(new yii\web\Application($config))->run();


try {
  
  } catch (Exception $e) {
     //var_dump($e);
  echo $e->getMessage()."<br/>";
  echo $e->getCode."<br/>";
  echo $e->getFile()."<br/>";
  echo $e->getLine()."<br/>";
  
  var_dump( $e );

}
/**/

// var_dump( Yii::$app->urlManager );

