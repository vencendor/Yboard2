<?php
/* @var $this MessagesController */
/* @var $model Messages */

/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="form">

    <?php
    $form = ActiveForm::begin(array(
        'id' => 'messages-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'sender_id')->textInput(); ?>

    </div>

    <div class="row">
        <?php echo $form->field($model, 'receiver_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'message', array('rows' => 6, 'cols' => 50))->textInput(); ?>

    </div>

    <div class="row">
        <?php echo $form->field($model, 'send_date')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'read_date')->textInput(); ?>
    </div>

    <div class="row buttons">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->