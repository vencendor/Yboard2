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
use app\models\Messages;
use yii\data\ArrayDataProvider;

class MessagesController extends DefaultController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/main-template';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view'),
                'users' => array('@'),
            ),
            array('allow', // allow view user to perform 'view' and 'delete' actions
                'actions' => array('view', 'delete'),
                'users' => array('view'),
            ),
                /*
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ),
                 * 
                 */
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        return $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDialog($user) {
        $model = new Messages;


        $query = Messages::find()->where(['or',
            ['and', ['sender_id' => $user, 'receiver_id'=>Yii::$app->user->id] ],
            ['and', ['sender_id' => Yii::$app->user->id, 'receiver_id'=>$user] ]
        ]);

        $dataProvider = new ActiveDataProvider('Messages', array(
            'query' => $query
        ));

        $userData = User::findOne($user);

        return $this->render('dialog', array(
            'dataProvider' => $dataProvider,
            'userData' => $userData,
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id) {
        $model = new Messages;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //var_dump(Yii::$app->request->getPost('Messages'));

        if (Yii::$app->request->post('Messages')) {
            $model->attributes = \Yii::$app->request->post('Messages');
            $model->receiver_id = $id;
            $model->sender_id = Yii::$app->user->id;
            $model->send_date = date('Y-m-d H:i:s'); //тупо но не нашел быстрого решения

            if ($model->validate()) {
                $model->save();
                $this->redirect(array('messages/dialog', 'user' => $id));
            }
        }

        return $this->render('create', array(
            'model' => $model,
            'receiver' => $id,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Messages'])) {
            $model->attributes = $_POST['Messages'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via view grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view'));
    }

    /**
     * Вывод пользователей с которыми ведется переписка
     * для текущего пользователя
     */
    public function actionIndex() {

        // --- Переделать в более подходящий вид
        $command = Yii::$app->db->
                createCommand('SELECT max(messages.send_date) as last_date, '
                . 'count(distinct messages.id) as count_mes, users.username, '
                . 'if(receiver_id="' . Yii::$app->user->id . '",sender_id,receiver_id) as interlocutor '
                . 'FROM messages left join users on users.id=sender_id or '
                . 'users.id=receiver_id and users.id!="' . Yii::$app->user->id . '" '
                . 'where sender_id="' . Yii::$app->user->id . '" or '
                . 'receiver_id="' . Yii::$app->user->id . '" group by interlocutor');

        $mesData = $command->queryAll();

        $dataProvider = new ArrayDataProvider( array(
            'allModels' => $mesData,
            'id' => 'interlocutor',
            'sort' => array(
                'attributes' => array(
                    'interlocutor'
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));

        return $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Messages('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Messages']))
            $model->attributes = $_GET['Messages'];

        return $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Messages the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Messages::findOne($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Messages $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'messages-form') {
            echo CActiveForm::validate($model);
            Yii::$app->end();
        }
    }

}
