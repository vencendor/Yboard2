<? return array (
  'id' => 'Yboard2',  
  'basePath' => __DIR__ . '/..',
  'language' => 'ru-RU',
  'name' => 'Zigzigz zig',
  'bootstrap' => 
  array (
    0 => 'log',
    1 => 'debug',
  ),
  'aliases' => 
  array (
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
    '@config' => '@app/config',
  ),
  'modules' => 
  array (
    'gii' => 
    array (
      'class' => 'yii\\gii\\Module',
      'allowedIPs' => 
      array (
        0 => '127.0.0.1',
        1 => '::1',
        2 => '192.168.0.*',
        3 => '192.168.178.20',
      ),
    ),
    'debug' => 
    array (
      'class' => 'yii\\debug\\Module',
    ),
    'admin' => 
    array (
      'class' => 'app\\modules\\admin\\AdminModule',
    ),
  ),
  'components' => 
  array (
    'request' => 
    array (
      'cookieValidationKey' => 'ba72a75d2502ab4172156918eb5ea627',
    ),
    'user' => 
    array (
      'identityClass' => 'app\\models\\User',
      'enableAutoLogin' => true,
      'class' => 'app\\components\\WebUser',
    ),
    'cache' => 
    array (
      'class' => 'yii\\caching\\FileCache',
    ),
    'authManager' => 
    array (
      'class' => 'yii\\rbac\\PhpManager',
    ),
    'urlManager' => 
    array (
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => 
      array (
        'admin/' => 'admin/default/index',
        'defaultRoute' => 'site/index',
        'sitemap.xml' => 'site/sitemapxml',
        '<id:\\d+>' => 'adverts/view/id/<id>',
        'category/<cat_id:\\d+>' => 'adverts/category',
        'logout' => 'login/logout',
        'site/login' => 'login/login',
        '/banner_edit' => '/view/banners/edit',
        '/banner_show' => '/view/banners/show',
        'site/category/<cat_id:\\d+>' => 'adverts/category/cat_id/<cat_id>',
        'cat_fields/<cat_id:\\d+>' => 'adverts/getfields',
        'view/moderate/<adv_id:\\d+>' => 'view/adverts/moderate/id/<adv_id>',
        'category/<action:\\w+>/' => 'view/category/<action>',
        'user/<id:\\d+>/' => 'user/view',
        '<controller:\\w+>/<id:\\d+>' => '<controller>/view',
        '<controller:\\w+>/<action:\\w+>/<id:\\d+>' => '<controller>/<action>',
        '<controller:\\w+>/<action:\\w+>' => '<controller>/<action>',
      ),
    ),
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=yyyy2',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '123456',
      'charset' => 'utf8',
      'tablePrefix' => '',
    ),
    0 => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=yboard',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '123456',
      'charset' => 'utf8',
      'tablePrefix' => '',
    ),
    'i18n' => 
    array (
      'translations' => 
      array (
        'lang*' => 
        array (
          'class' => 'yii\\i18n\\PhpMessageSource',
          'fileMap' => 
          array (
            'lang' => 'lang.php',
          ),
        ),
      ),
    ),
    'errorHandler' => 
    array (
      'errorAction' => 'site/error',
    ),
    'log' => 
    array (
      'traceLevel' => 3,
      'targets' => 
      array (
        0 => 
        array (
          'class' => 'yii\\log\\FileTarget',
          'levels' => 
          array (
            0 => 'error',
            1 => 'warning',
          ),
          'maxLogFiles' => 10,
        ),
      ),
    ),
  ),
  'params' => require 'settings.php',
  'controllerMap' => 
  array (
    'adverts' => 'app\\controllers\\AdvertsController',
    'user' => 'app\\controllers\\UserController',
  ),
) ?>
