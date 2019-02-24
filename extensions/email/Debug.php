<?php

class Debug extends CWidget {

    public function run() {
        if (Yii::$app->user->hasFlash('email')) {
            //register css file
            $url = Html::asset(Yii::getAlias('application.extensions.email.css.debug') . '.css');
            Yii::$app->getClientScript()->registerCssFile($url);

            //dump debug info
            echo Yii::$app->session->getFlash('email');
            //Yii::$app->user->setFlash('email', null);
        }
    }

}
