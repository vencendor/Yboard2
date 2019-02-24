<?php
/* @var $this MessagesController */
/* @var $model Messages */
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

<?php echo $form->field($model, 'sender_id')->textInput(); ?>
    </div>

    <div class="row">
<?php echo $form->field($model, 'receiver_id')->textInput(); ?>
    </div>

    <div class="row">
<?php echo $form->field($model, 'message', array('rows' => 6, 'cols' => 50))->textarea(); ?>
    </div>

    <div class="row">

<?php echo $form->field($model, 'send_date')->textInput(); ?>
    </div>

    <div class="row">

<?php echo $form->field($model, 'read_date')->textInput(); ?>
    </div>

    <div class="row buttons">
    <?php echo Html::submitButton('Search'); ?>
    </div>

<?php ActiveForm::end(); ?>

</div><!-- search-form -->