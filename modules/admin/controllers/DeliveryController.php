<?php

namespace app\modules\admin\controllers;

use Yii;

class DeliveryController extends BackendController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/view-template';
    public $title = "Рассылка";
    public $error;

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be deleted
     */

    /**
     * Lists all models.
     */
    public function actionIndex() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $email = Yii::$app->email;
            $t_validator = new textValidator();

            $messages = "";

            $email->subject = Yii::$app->request->getParam('email_theme');
            $email->message = Yii::$app->request->getParam('email_body');

            if ($t_validator->validate_str($email->subject, "html")
                    and $t_validator->validate_str($email->message, "html")) {

                if (Yii::$app->request->getParam('users_page')) {
                    $users_page = intval(Yii::$app->request->getParam('users_page'));
                } else {
                    $users_page = 0;
                }

                $user_list = User::usersPage($users_page);

                foreach ($user_list as $us) {
                    $email->to = $us->email;
                    $messages .= "Отправленно сообщение на " . $email->to . "<br/>";
                    $email->send();
                }
            } else {
                $this->error = "Входные данные содержат недопустимые символы";
            }
        }
        return $this->render('/delivery', array('messages' => $messages));
    }

}
