<?php

namespace app\controllers;

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
use app\models\UserLogin;

class LoginController extends DefaultController {

    public $defaultAction = 'login';

    /**
     * Displays the login page
     */
    public function actionLogin() {

        if (Yii::$app->user->isGuest) {

            $model = new UserLogin();
            $model->load(Yii::$app->request->post());
            // collect user input data
            if (  $model->login() ) {

                return $this->goBack();
            }


            // display the login form
            return $this->render('/user/login', array('model' => $model));
        } else
            $this->redirect(array("site/index"));
    }

    public function actionUlogin() {

        if (isset($_POST['token'])) {
            $ulogin = new UloginModel();
            $ulogin->setAttributes($_POST);
            $ulogin->getAuthData();

            if ($ulogin->validate() && $ulogin->login()) {
                $this->redirect(Yii::$app->user->returnUrl);
            } else {

                return $this->render('error', array('errors' => $ulogin->errors));
            }
        } else {

            $this->redirect(Yii::$app->homeUrl, true);
        }
    }

    private function lastViset() {
        $lastVisit = User::notsafe()->findOne(Yii::$app->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        $this->redirect(Yii::$app->homeUrl);
    }

}
