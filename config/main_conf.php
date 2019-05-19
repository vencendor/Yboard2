<?php

return [
    'id' => 'Yboard2',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'name' => 'Доска объявлений',
    //'theme' => 'yboard',
    /*
      'preload' =>
      array(
      0 => 'log', 'languages'
      ),
      /**/
    /*
      'import' =>
      array(

      'application.models.*',
      'application.components.*',
      'application.modules.view.*',
      'application.modules.user.*',
      'application.modules.user.models.*',
      'application.modules.user.components.*',
      'application.extensions.*',
      'application.extensions.yii-mail.*',
      'application.extensions.configer.*',
      'application.extensions.gallerymanager.*',
      'application.extensions.gallerymanager.models.*',
      'application.extensions.nestedset.*',
      'application.extensions.sypexgeo.*',

      ),
      /**
     *  @brief /*
     *  
     *  @return Return description
     *  
     *  @details More details
     */
    'bootstrap' => ['log', 'debug'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@config' => '@app/config',
    ],
    'modules' =>
        [

            'gii' => [
                'class' => 'yii\gii\Module',
                'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // регулируйте в соответствии со своими нуждами
            ],

            'debug' => [
                'class' => 'yii\debug\Module',
            ],

            'admin' => [
                'class' => 'app\modules\admin\AdminModule',
            ],
            /*
              'cms',
              /* */
        ],
    /**/
    'components' =>
        [
            /*
              'languages' => array(
              'class' => 'Languages',
              'useLanguage' => true,
              'autoDetect' => true,
              'languages' => array('ru', 'en', 'it'),
              'languagesTitles' => array('ru' => 'Russian', 'en' => 'English', 'it' => 'Italian'),
              ),
             */
            'request' => [
                'cookieValidationKey' => md5('asdFw42Q'),
            ],
            'user' =>
                [
                    'identityClass' => 'app\models\User',
                    'enableAutoLogin' => true,
                    'class' => 'app\components\WebUser',
                    // 'loginUrl' =>  [   0 => '/login',  ],
                ],
            'cache' =>
                [
                    'class' => 'yii\caching\FileCache',
                ],
            'authManager' => [
                'class' => 'yii\rbac\PhpManager',
            ],
            /*
              'evenness' =>
              array(
              'class' => 'Evenness',
              ),
              'bootstrap' =>
              array(
              'class' => 'bootstrap.components.Bootstrap',
              ),
              'image' =>
              array(
              'class' => 'application.extensions.image.CImageComponent',
              'driver' => 'GD',
              ),
              'email' =>
              array(
              'class' => 'application.extensions.email.Email',
              'delivery' => 'php',
              ),
              'config' =>
              array(
              'class' => 'application.extensions.EConfig',
              'strictMode' => false,
              ),
              /* */
            'urlManager' =>
                [
                    //'urlFormat' => 'path',
                    'enablePrettyUrl' => true,
                    'showScriptName' => false,
                    'rules' =>
                        array(
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
                            /**/
                        ),
                ],
            'db' => require __DIR__ . '/db.php',
            array(
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yboard',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '123456',
                'charset' => 'utf8',
                'tablePrefix' => '',
            ),
            'i18n' => [
                'translations' => [
                    'lang*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'fileMap' => [
                            'lang' => 'lang.php',
                        ],
                    ],
                ],
            ],
            /*
              'errorHandler' =>
              array(
              'class' => 'application.modules.cms.components.CmsHandler',
              ),
             /**/
            /*
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],

            /* */
            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
        ],
    'params' => require 'settings.php',
    'controllerMap' => [
        'adverts' => 'app\controllers\AdvertsController',
        'user' => 'app\controllers\UserController',
    ],
]
?>