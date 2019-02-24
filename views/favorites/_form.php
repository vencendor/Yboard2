<?php
/* @var $this FavoritesController */
/* @var $model Favorites */
/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="form">

    <?php
    $form = ActiveForm::begin( array(
        'id' => 'favorites-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'user_id'); ?>
<?php echo $form->textField($model, 'user_id'); ?>
<?php echo $form->field($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'obj_id'); ?>
<?php echo $form->textField($model, 'obj_id'); ?>
<?php echo $form->field($model, 'obj_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'obj_type'); ?>
<?php echo $form->textField($model, 'obj_type'); ?>
<?php echo $form->field($model, 'obj_type'); ?>
    </div>

    <div class="row buttons">
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php ActiveForm::end(); ?>

</div><!-- form -->