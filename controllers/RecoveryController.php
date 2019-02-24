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

class RecoveryController extends DefaultController {

    public $defaultAction = 'recovery';

    /**
     * Recovery password
     */
    public function actionRecovery() {
        $form = new UserRecoveryForm;
        if (Yii::$app->user->id) {
            $this->redirect(Yii::$app->controller->module->returnUrl);
        } else {
            $email = ((isset($_GET['email'])) ? $_GET['email'] : '');
            $activkey = ((isset($_GET['activkey'])) ? $_GET['activkey'] : '');
            if ($email && $activkey) {
                $form2 = new UserChangePassword;
                $find = User::notsafe()->findByAttributes(array('email' => $email));
                if (isset($find) && $find->activkey == $activkey) {
                    if (isset($_POST['UserChangePassword'])) {
                        $form2->attributes = $_POST['UserChangePassword'];
                        if ($form2->validate()) {
                            $find->password = Yii::$app->controller->module->encrypting($form2->password);
                            $find->activkey = Yii::$app->controller->module->encrypting(microtime() . $form2->password);
                            if ($find->status == 0) {
                                $find->status = 1;
                            }
                            $find->save();
                            Yii::$app->user->setFlash('recoveryMessage', t("New password is saved."));
                            $this->redirect(Yii::$app->controller->module->recoveryUrl);
                        }
                    }
                    return $this->render('changepassword', array('form' => $form2));
                } else {
                    Yii::$app->user->setFlash('recoveryMessage', t("Incorrect recovery link."));
                    $this->redirect(Yii::$app->controller->module->recoveryUrl);
                }
            } else {
                if (isset($_POST['UserRecoveryForm'])) {
                    $form->attributes = $_POST['UserRecoveryForm'];
                    if ($form->validate()) {
                        $user = User::notsafe()->findOne($form->user_id);
                        $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl(implode(Yii::$app->controller->module->recoveryUrl), array("activkey" => $user->activkey, "email" => $user->email));

                        $subject = t("You have requested the password recovery site {site_name}", array(
                            '{site_name}' => Yii::$app->name,
                        ));
                        $message = t("You have requested the password recovery site {site_name}. To receive a new password, go to {activation_url}.", array(
                            '{site_name}' => Yii::$app->name,
                            '{activation_url}' => $activation_url,
                        ));


                        Yii::$app->email->to = $user->email;
                        Yii::$app->email->subject = $subject;
                        Yii::$app->email->message = $message;
                        Yii::$app->email->send();


                        Yii::$app->user->setFlash('recoveryMessage', t("Please check your email. An instructions was sent to your email address."));
                        $this->refresh();
                    }
                }
                return $this->render('recovery', array('form' => $form));
            }
        }
    }

}
