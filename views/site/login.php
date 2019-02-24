<?php
/* @var $this SiteController */
/* @var $model LoginForm */

/* @var $form CActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* ------------- not used ----------------- */

$this->context->pageTitle = Yii::$app->name . ' - Login';
echo Breadcrumbs::widget(array(
    'Login',
));
?>

<h1>Login</h1>


<div class="form">
    <?php
    $form = ActiveForm::begin(array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="row">
        <?php echo $form->field($model, 'username')->textInput(); ?>

    </div>

    <div class="row">

        <?php echo $form->field($model, 'password')->passwordInput(); ?>

        <p class="hint">
            Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
        </p>
    </div>

    <div class="row rememberMe">
        <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
    </div>

    <div class="row buttons">
        <?php echo Html::submitButton('Login'); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div><!-- form -->
