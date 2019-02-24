<?php
/* @var $this AnswerController */
/* @var $model Answer */
/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="form well">

    <?php
    $form = ActiveForm::begin( array(
        'id' => 'answer-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'parent_id'); ?>
        <?php echo $form->textField($model, 'parent_id'); ?>
        <?php echo $form->field($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
        <?php echo $form->field($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->field($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'created_at'); ?>
        <?php echo $model->created_at; ?>
        <?php echo $form->field($model, 'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'updated_at'); ?>
        <?php echo $model->updated_at; ?>
        <?php echo $form->field($model, 'updated_at'); ?>
    </div>

    <div class="row buttons">
        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->