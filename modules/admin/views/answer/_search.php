<?php
/* @var $this AnswerController */
/* @var $model Answer */
/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="wide form">

    <?php
    $form = ActiveForm::begin( array(
        'action' => Url::to($this->route),
        'method' => 'get',
        'id' => 'verticalForm',
        'options' => array('class' => 'well'),
    ));
    ?>

    <div class="row">
        <?php echo $form->field($model, 'id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'parent_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'text', array('rows' => 6, 'cols' => 50))->textarea(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'created_at')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'updated_at')->textInput(); ?>
    </div>

    <div class="row buttons">
        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- search-form -->