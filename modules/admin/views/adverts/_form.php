<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */
/* @var $categories array */

use yii\widgets\ActiveForm;

?>

<div class="form well">

    <?php
    $form = ActiveForm::begin( array(
        'id' => 'bulletin-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->field($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
        <?php echo $form->field($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php $this->widget('application.widgets.BulletinCategoryWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
        <?php $this->widget('application.widgets.BulletinTypeWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'views'); ?>
        <?php echo $form->textField($model, 'views'); ?>
        <?php echo $form->field($model, 'views'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->field($model, 'text'); ?>
    </div>

    <div class="row buttons">
        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->