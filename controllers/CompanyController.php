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

class CompanyController extends DefaultController {

    public $defaultAction = 'index';
    public $layout = '//main-template';

    /**
     * @var ActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Shows a particular model.
     */
    public function actionView() {
        $model = $this->loadUser();
        return $this->render('profile', array(
            'model' => $model,
            'profile' => $model->profile,
        ));
    }

    public function actionIndex() {

        $query = Post::find()->where(['status' => 1]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'title' => SORT_ASC,
                ]
            ],
        ]);


        $query = Profile::find()->limit(10);

        $dataProvider = new ActiveDataProvider( array(
            'query' => $query
        ));

        return $this->render('index', array(
            'dataProvider' => $dataProvider,
                )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionEdit() {
        $model = $this->loadUser();
        $profile = $model->profile;

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::$app->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $profile->attributes = $_POST['Profile'];

            if ($model->validate() && $profile->validate()) {
                $model->save();
                $profile->save();
                Yii::$app->user->updateSession();
                Yii::$app->user->setFlash('profileMessage', t("Changes is saved."));
                $this->redirect(array('/user/profile'));
            } else
                $profile->validate();
        }

        return $this->render('edit', array(
            'model' => $model,
            'profile' => $profile,
        ));
    }

}
