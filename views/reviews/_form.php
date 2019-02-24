<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="form">

    <?php
    $form = ActiveForm::begin(array(
        'id' => 'reviews-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'profile_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'type')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'review')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'vote')->textInput(); ?>
    </div>

    <div class="row buttons">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->