<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

/* @var $form CActiveForm */

use yii\widgets\ActiveForm;

?>

<div class="wide form">

    <?php
    $form = ActiveForm::begin(array(
        'action' => Url::to($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->field($model, 'id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'obj_id')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'obj_type')->textInput(); ?>
    </div>

    <div class="row buttons">
        <?php echo Html::submitButton('Search'); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- search-form -->