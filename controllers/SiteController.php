<?php

namespace app\controllers;

use app\models\InstallForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\controllers\DefaultController;
use app\models\ConfigForm;



/**
 * Контролер сайта включающий отдельные возможности 
 * Процедура установки 
 * Форма контактов 
 * Вывод дополнительных поляй для категории actionGetfields 
 */
class SiteController extends DefaultController {

    /**
     * Declares class-based actions.
     * 
     */
    public $layout = '/main-template';
    
    
    public function actions() {
        return array(
            // Дублирование, метода "создание объявления" удален
            // 'create' => 'application.controllers.site.CreateAction',
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'page' => array(
                'class' => 'CViewAction',
            ),
            'sitemap' => array(
                'class' => 'ext.sitemap.ESitemapAction',
                'importListMethod' => 'getBaseSitePageList',
                'classConfig' => array(
                    array('baseModel' => 'Adverts',
                        'route' => '/adverts/view',
                        'params' => array('id' => 'id')),
                    array('baseModel' => 'Category',
                        'route' => '/adverts/category',
                        'params' => array('cat_id' => 'id')),
                ),
            ),
            'sitemapxml' => array(
                'class' => 'ext.sitemap.ESitemapXMLAction',
                'classConfig' => array(
                    array('baseModel' => 'Adverts',
                        'route' => '/adverts/view',
                        'params' => array('id' => 'id')),
                    array('baseModel' => 'Category',
                        'route' => '/adverts/category',
                        'params' => array('cat_id' => 'id')),
                ),
                //'bypassLogs'=>true, // if using yii debug toolbar enable this line
                'importListMethod' => 'getBaseSitePageList',
            ),
        );
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function actionLanguage($lang) {

        $referer = Yii::$app->request->urlReferrer;

        Yii::$app->session->add('language', $lang);

        if ($referer) {
            $this->redirect($referer);
        } else {
            $this->redirect(array("site/index"));
        }
    }

    /**
     * Получения списка дополнительных полей для категории 
     * используется при созданий объявления
     * @param type $cat_id Id категории 
     */
    public function actionGetfields($cat_id) {
        $model = Category::findOne($cat_id);

        $fields = json_decode($model->fields);

        if (sizeof($fields) > 0) {
            foreach ($fields as $f_iden => $fv) {
                ?><div class="controls">
                    <label for='Fields[<?= $f_iden ?>]'><?= $fv->name ?></label>
                    <input type="text" id="Fields[<?= $f_iden ?>]" name="Fields[<?= $f_iden ?>]" >
                </div><? 
            }
        }
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform actions
                'actions' => array('index', 'error', 'contact', 'bulletin', 'category', 'captcha', 'page', 'advertisement', 'getfields', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow view user
                'actions' => array('importUsers', 'importBulletins'),
                'users' => array('view'),
            ),
        );
    }

    /**
     * Вывод главной
     * отличается наличием виджета категорий вверху
     */
    public function actionIndex() {


        global $config_path;

        if (is_file(dirname($config_path) . "/install")) {

            //------------------- Start install------------------
            return $this->redirect("site/install");
        }

        $roots = Category::find()->roots()->all();

        
        // $query = (new Query())->from('post')->where(['status' => 1]);
        $query = \app\models\Adverts::find()->where('id <> 1');
        

        // Articles on main page


        $this->indexAdv = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        /**/

        
        Yii::$app->view->params['indexAdv'] = $this->indexAdv;
        
        return $this->render('index', array(
            'roots' => $roots,
        ));
        /**/
    }

    public function actionInstall() {

        global $config_path; // Путь к файлу конфигурации для его изменения
        $this->layout = "install-layout";
        $db_error = false;
        $error = false;
        $model = new InstallForm();




        if (is_file(dirname($config_path) . "/install")) {


            if (!is_writable($config_path)) {
                $model->addError("site_name", "Файл " . $config_path . " должен быть доступен для записи");
            }

            if (!is_writable(Yii::getAlias('@config/settings') . ".php")) {
                $model->addError("site_name", "Файл "
                        . Yii::getAlias('@config/settings') . ".php"
                        . " должен быть доступен для записи");
            }

            if (!is_writable(Yii::getAlias('@runtime'))) {
                $model->addError("site_name", "папка "
                        . Yii::getAlias('@runtime')
                        . " должена быть доступена для записи");
            }


            if (!is_writable(Yii::$app->basePath . "/assets")) {
                $model->addError("site_name", "папка /assets должена быть доступена для записи");
            }

            if (ini_get("short_open_tag") === "Off" or ! ini_get("short_open_tag")) {
                $error = t("Your configuration requires changes.") . t("
short_open_tag option must be enabled in the php.ini or another method available");
            }



            if ( isset($_POST['InstallForm']) and ! $error ) {

                // dd( isset($_POST['InstallForm']) and ! $error  );

                $model->attributes = $_POST['InstallForm'];


                // данные Mysql 
                $server = trim(stripslashes($_POST['InstallForm']['mysql_server']));
                $username = trim(stripslashes($_POST['InstallForm']['mysql_login']));
                $password = trim(stripslashes($_POST['InstallForm']['mysql_password']));
                $db_name = trim(stripslashes($_POST['InstallForm']['mysql_db_name']));

                // данные пользователя                     
                if (!$model->validate() or $model->userpass !== $model->userpass2) {
                    $model->addError('userpass2', "Пароли не совпадают");
                }



                if (!$model->errors) {
                    $db_con = mysqli_connect($server, $username, $password) or $db_error = mysqli_error();
                    mysqli_set_charset($db_con, "utf8");
                    mysqli_select_db($db_con, $db_name) or $db_error = mysqli_error($db_con);
                }

                if (!$db_error and ! $model->errors) {
                    $config_data = require $config_path;

                    $dump_file = file_get_contents(Yii::getAlias('@app/data/install') . '.sql');

                    // Сохранение данных о пользователе 
                    $dump_file .= " INSERT INTO `users` 
                                    (`username`, `password`, `email`, `activkey`, `superuser`, `status`)     VALUES "
                            . "('" . $model->username . "', '" . Yii::$app->user->crypt($model->userpass) . "', "
                            . "'" . $model->useremail . "', '" . Yii::$app->user->crypt(microtime() . $model->userpass) . "',"
                            . " 2, 1);";

                    mysqli_multi_query($db_con, $dump_file) or $db_error = mysqli_error($db_con);

                    if (!$db_error) {
                        // Заполнение конфигурации
                        $config_data['components']['db'] = array(
                            'class' => 'yii\db\Connection',
                            'dsn' => 'mysql:host=' . $server . ';dbname=' . $db_name,
                            'emulatePrepare' => true,
                            'username' => $username,
                            'password' => $password,
                            'charset' => 'utf8',
                            'tablePrefix' => '',
                        );
                        $config_data['name'] = trim(stripslashes($_POST['InstallForm']['site_name']));
                        $config_data['params'] = "require";

                        $config_array_str = var_export($config_data, true);
                        $config_array_str = str_replace("'params' => 'require',", "'params' => require 'settings.php',", $config_array_str);
                        //Сохранение конфигурации 
                        file_put_contents($config_path, "<? return " . $config_array_str . " ?>");

                        // Сохранение настроек
                        $settings = new ConfigForm(Yii::getAlias('@config/settings') . ".php");
                        $settings->updateParam('adminEmail', $model->useremail);
                        $settings->saveToFile();

                        unlink(dirname($config_path) . "/install");

                        $this->redirect(array('site/index'));
                    }
                }
            }


            return $this->render('install', array('model' => $model, 'db_error' => $db_error, 'error' => $error));


        } else {
            $this->redirect(array('site/index'));
        }
    }


    public function actionAbout() {
        return $this->render('pages/about');
    }

    public function actionGeoIp() {

        //Yii::import('ext.sypexgeo.Sypexgeo');

        $geo = new Sypexgeo();

        // get by remote IP
        $geo->get('85.250.187.241');                // also returned geo data as array
        echo $geo->ip, '<br>';
        echo $geo->ipAsLong, '<br>';
        var_dump($geo->country);
        echo '<br>';
        var_dump($geo->region);
        echo '<br>';
        var_dump($geo->city);
        echo '<br>';

        // get by custom IP
        //$geo->get('212.42.76.252');
    }

    /**
     * Displays the contact page
     * @param int $id User's id
     */
    public function actionContact($id = null) {
        $user = $id ? $this->loadUser($id) : null;
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";
                $mail = $user ? $user->email : Yii::$app->params['adminEmail'];

                mail($mail, $subject, $model->body, $headers);
                Yii::$app->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        return $this->render('contact', array('model' => $model, 'user' => $user));
    }

    public function actionCron($code) {
        if ($code === Yii::$app->params['cron_code']) {
            $list = Yii::$app->db->createCommand("select count(adverts.id) as count, location, category_id, max(created_at) as last_date from adverts group by location, category_id")->queryAll();

            $day_seconds = 3600 * 24;

            foreach ($list as $ad) {

                $days = 0;
                if ($ad['count'] > 90)
                    $days = 2;
                if ($ad['count'] > 70 and $ad['count'] < 90)
                    $days = 3;
                if ($ad['count'] > 60 and $ad['count'] < 70)
                    $days = 4;
                if ($ad['count'] > 50 and $ad['count'] < 60)
                    $days = 5;
                if ($ad['count'] > 40 and $ad['count'] < 50)
                    $days = 6;
                if ($ad['count'] > 30 and $ad['count'] < 40)
                    $days = 7;
                if ($ad['count'] > 20 and $ad['count'] < 30)
                    $days = 8;
                if ($ad['count'] > 10 and $ad['count'] < 20)
                    $days = 9;
                if ($ad['count'] < 10)
                    $days = 10;


                if (strtotime($ad['last_date']) + $day_seconds * 10 < time()) {
                    $count = Adverts::updateAll(array('created_at' => 'DATE_ADD(created_at, INTERVAL ' . $days . ' DAY)')
                            , " location='" . $ad['location'] . "' and category_id ='" . $ad['category_id'] . "' ");

                    var_dump($count);
                }
            }
        }
    }

    public function actionView($id) {
        $model = $this->loadAdvert($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
        return $this->render('bulletin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadAdvert($id) {
        $model = loadAdvert::findOne($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadCategory($id) {
        $model = Category::findOne($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadUser($id) {
        $model = User::findOne($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function getBaseSitePageList() {

        $list = array(
            array(
                'loc' => Yii::$app->createAbsoluteUrl('/'),
                'frequency' => 'weekly',
                'priority' => '1',
            ),
            array(
                'loc' => Yii::$app->createAbsoluteUrl('/site/contact'),
                'frequency' => 'yearly',
                'priority' => '0.8',
            ),
            array(
                'loc' => Yii::$app->createAbsoluteUrl('/site/page', array('view' => 'about')),
                'frequency' => 'monthly',
                'priority' => '0.8',
            ),
            array(
                'loc' => Yii::$app->createAbsoluteUrl('/site/page', array('view' => 'privacy')),
                'frequency' => 'yearly',
                'priority' => '0.3',
            ),
        );
        return $list;
    }

    public function actionLocation_list($term) {
        if ($term) {
            echo json_encode(Location::CitiesSuggest($term));
        } else {
            return false;
        }
    }

    public function actionGetRegions($id = "") {
        if ($id) {
            echo Html::dropDownList('selectRegions', "", Location::Regions($id), array(
                "onchange" => "getCityList()",
                "class" => "form-control",
                "empty" => t("Select region"),
            ));
        } else {
            return false;
        }
    }

    public function actionGetCities($id = "") {
        if ($id) {
            echo Html::dropDownList('selectCities', "", Location::Cities($id), array(
                "onchange" => "locationSelect()",
                "class" => "form-control",
                "empty" => t("Select city")
            ));
        } else {
            return false;
        }
    }

}
