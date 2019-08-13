<?

use yii\helpers\ArrayHelper;

$db = ArrayHelper::merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/db-local.php')
);

return [
    'id'            => 'Yboard2',
    'basePath'      => __DIR__ . '/..',
    'language'      => 'ru-RU',
    'name'          => 'Zigzigz zig',
    'bootstrap'     => [
        0 => 'log',
        1 => 'debug',
    ],
    'aliases'       => [
        '@bower'  => '@vendor/bower-asset',
        '@npm'    => '@vendor/npm-asset',
        '@config' => '@app/config',
    ],
    'modules'       => [
        'gii'   => [
            'class'      => 'yii\\gii\\Module',
            'allowedIPs' => [
                0 => '127.0.0.1',
                1 => '::1',
                2 => '192.168.0.*',
                3 => '192.168.178.20',
            ],
        ],
        'debug' => [
            'class' => 'yii\\debug\\Module',
        ],
        'admin' => [
            'class' => 'app\\modules\\admin\\AdminModule',
        ],
    ],
    'components'    => [
        'request'      => [
            'cookieValidationKey' => 'ba72a75d2502ab4172156918eb5ea627',
        ],
        'user'         => [
            'identityClass'   => 'app\\models\\User',
            'enableAutoLogin' => true,
            'class'           => 'app\\components\\WebUser',
        ],
        'cache'        => [
            'class' => 'yii\\caching\\FileCache',
        ],
        'authManager'  => [
            'class' => 'yii\\rbac\\PhpManager',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                'admin/'                                    => 'admin/default/index',
                'defaultRoute'                              => 'site/index',
                'sitemap.xml'                               => 'site/sitemapxml',
                '<id:\\d+>'                                 => 'adverts/view/id/<id>',
                'category/<cat_id:\\d+>'                    => 'adverts/category',
                'logout'                                    => 'login/logout',
                'site/login'                                => 'login/login',
                '/banner_edit'                              => '/view/banners/edit',
                '/banner_show'                              => '/view/banners/show',
                'site/category/<cat_id:\\d+>'               => 'adverts/category/cat_id/<cat_id>',
                'cat_fields/<cat_id:\\d+>'                  => 'adverts/getfields',
                'view/moderate/<adv_id:\\d+>'               => 'view/adverts/moderate/id/<adv_id>',
                'category/<action:\\w+>/'                   => 'view/category/<action>',
                'user/<id:\\d+>/'                           => 'user/view',
                '<controller:\\w+>/<id:\\d+>'               => '<controller>/view',
                '<controller:\\w+>/<action:\\w+>/<id:\\d+>' => '<controller>/<action>',
                '<controller:\\w+>/<action:\\w+>'           => '<controller>/<action>',
            ],
        ],
        'db'           => $db,
        0              => [
            'class'          => 'yii\\db\\Connection',
            'dsn'            => 'mysql:host=localhost;dbname=yboard',
            'emulatePrepare' => true,
            'username'       => 'root',
            'password'       => '123456',
            'charset'        => 'utf8',
            'tablePrefix'    => '',
        ],
        'i18n'         => [
            'translations' => [
                'lang*' => [
                    'class'   => 'yii\\i18n\\PhpMessageSource',
                    'fileMap' => [
                        'lang' => 'lang.php',
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log'          => [
            'traceLevel' => 3,
            'targets'    => [
                0 => [
                    'class'       => 'yii\\log\\FileTarget',
                    'levels'      => [
                        0 => 'error',
                        1 => 'warning',
                    ],
                    'maxLogFiles' => 10,
                ],
            ],
        ],
    ],
    'params'        => require 'settings.php',
    'controllerMap' => [
        'adverts' => 'app\\controllers\\AdvertsController',
        'user'    => 'app\\controllers\\UserController',
    ],
] ?>