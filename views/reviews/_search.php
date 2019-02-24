<?php
/* @var $this ReviewsController */
/* @var $model Reviews */
/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="wide form">

    <?php
    $form = ActiveForm::begin( array(
        'action' => Url::to($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">

<?php echo $form->field($model, 'id')->textInput(); ?>
    </div>

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
<?php echo $form->textArea($model, 'review', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
<?php echo $form->field($model, 'vote')->textInput(); ?>
    </div>

    <div class="row buttons">
    <?php echo Html::submitButton('Search'); ?>
    </div>

<?php ActiveForm::end(); ?>

</div><!-- search-form -->