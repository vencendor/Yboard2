<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
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
        <?php echo $form->field($model, 'name', array('size' => 60, 'maxlength' => 255))->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'category_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'type')->checkbox(); ?>
    </div>

    <div class="row">
       <?php echo $form->field($model, 'views')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'text', array('rows' => 6, 'cols' => 50))->textarea(); ?>
    </div>

    <div class="row buttons">
        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- search-form -->