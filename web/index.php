<?php


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors",1);

ob_start();

// Путь используется в определений начальной папки
$config_path = __DIR__ . '/../config/main_conf.php';
$config = require $config_path;
require(__DIR__ . '/../helpers.php');

try {
    (new yii\web\Application($config))->run();
} catch( Exception $e ){
    dump( $e );
}



