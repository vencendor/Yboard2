<?
use yii\widgets\ActiveForm;

?>
<div class="form">

    <?php
    $form = ActiveForm::begin( array(
        'id' => 'cms-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'parent_id'); ?>
<?php echo $form->dropDownList($model, 'parent_id', $model->getParents()); ?>
<?php echo $form->field($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->field($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'url'); ?>
<?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->field($model, 'url'); ?>
    </div>

    <div class="row buttons">
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
<?php echo Html::hiddenField('type', Cms::LINK); ?>
<?php ActiveForm::end(); ?>

</div><!-- form -->