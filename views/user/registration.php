<?php

use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\bootstrap\Button;

$this->context->pageTitle = Yii::$app->name . ' - ' . t("Registration");
echo Breadcrumbs::widget([
        "links" => [ "label" => t("Registration"), ]
]);
?>

<h1><?php echo t("Registration"); ?></h1>

<?php if ( \Yii::$app->session->hasFlash('registration')): ?>
    <div class="success">
        <?php echo Yii::$app->session->getFlash('registration'); ?>
    </div>
<?php else: ?>

    <div class="form well">
        <?php
        $form = ActiveForm::begin( array(
            'id' => 'registration-form',
            'enableAjaxValidation' => false,
                //'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
                /*
                  'clientOptions' => array(
                  'validateOnSubmit' => true,
                  ),
                 * 
                 */
                'options' => array('enctype' => 'multipart/form-data'),
        ));


        ?>

        <p class="note"><?php echo t('Fields with <span class="required">*</span> are required.'); ?></p>


        <div >

            <?= $form->field($model, 'username')->textInput(); ?>
        </div>

        <div >
            <?php echo $form->field($model, 'password')->textInput(); ?>
            <p class="hint">
                <?php echo t("Minimal password length 4 symbols."); ?>
            </p>
        </div>

        <div >
            <?php echo $form->field($model, 'verifyPassword')->textInput(); ?>
        </div>

        <div >
            <?php echo $form->field($model, 'email')->textInput(); ?>
        </div>

        <?php

        $profileFields = $profile->getFields();

        if ($profileFields) {
            foreach ($profileFields as $field) {
                ?>
                <div>
                    <?php echo $form->field($profile, $field->varname); ?>
                    <?php
                    if ($widgetEdit = $field->widgetEdit($profile)) {
                        echo $widgetEdit;
                    } elseif ($field->range) {
                        echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                    } elseif ($field->field_type == "TEXT") {
                        echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                    } else {
                        echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                    }
                    ?>
                    <?php echo $form->field($profile, $field->varname); ?>
                </div>
                <?php
            }
        }

        ?>
        <div >
            <?php echo $form->field($model, 'verifyCode')->textInput(); ?>

            <p class="hint"><?php echo t("Please enter the letters as they are shown in the image above."); ?>
                <br/><?php echo t("Letters are not case-sensitive."); ?></p>
        </div>


        <div class="row submit">	
            <?php
            echo Button::widget( array(
                'label' => "Зарегистрироваться"
            ));
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div><!-- form -->
<?php endif; ?>