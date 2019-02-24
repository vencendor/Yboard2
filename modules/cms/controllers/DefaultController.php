<?php

class DefaultController extends Controller {

    public $layout = '//main-template';

    public function actionIndex() {
        return $this->render('index');
    }

}
