<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;

class BackendController extends Controller {

    public $layout = 'admin-template';
    public $title;
    public $pageTitle;
    public $menu = array();

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
            array('allow', // allow view user to perform 'view' and 'delete' actions
                'users' => User::getAdmins(),
            ),
            array('deny', // deny all users
                'users' => array("*"),
            ),
        );
    }

}

?>
