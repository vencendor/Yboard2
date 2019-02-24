<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="form">

    <?php
    $form = ActiveForm::begin(array(
        'id' => 'messages-form',
        'enableAjaxValidation' => false,
        'action' => Url::toRoute(['messages/create', 'id' => $receiver])
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>


        <?php echo $form->field($model, 'message')->textarea(); ?>


    <div class="row buttons">
        <?php echo Html::submitButton($model->isNewRecord ? t('Send') : t('Save'), array('class' => 'btn btn-light')); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->