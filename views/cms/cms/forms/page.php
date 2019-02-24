<?php


use yii\widgets\ActiveForm;

?>

<div class="form">

    <?php
    $form = ActiveForm::begin(array(
        'id' => 'cms-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <p class="note"><?= t('Fields with <span class="required">*</span> are required.') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->field($model, 'parent_id')->dropDownList( $model->getParents()); ?>
    </div>

    <div class="row">

        <?php echo $form->field($model, 'name', array('size' => 60, 'maxlength' => 255))->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'url', array('size' => 60, 'maxlength' => 255))->textInput(); ?>
        <div id="translit"></div>
    </div>

    <?php
    $this->publishJS();
    $this->initTranslit();
    ?>

    <table style="width:auto;margin:0;">
        <tr>
            <td>

                <?php echo $form->field($model, 'layout')->dropDownList($model->layouts, array('empty' => '')); ?>

            </td>
            <td>

                <?php echo $form->field($model, 'section')->dropDownList($model->sections, array('empty' => '')); ?>
            </td>
            <td>

                <?php echo $form->field($model, 'subsection')->dropDownList($model->subsections, array('empty' => '')); ?>
            </td>
        </tr>
    </table>

    <div class="row">

        <?php echo $form->field($model, 'access_level')->textInput(); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'content'); ?>
        <?php
        if ($this->FckEditorAvailable(0)) {
            $this->widget('application.extensions.ckeditor.CKEditor', array(
                'model' => $model,
                'attribute' => 'content',
                //'language'=>'ru',
                'editorTemplate' => 'full', //'basic'
                'skin' => 'v2'
            ));
        } else
            echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50));
        ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'title')->textInput(  array('size' => 60, 'maxlength' => 255) ); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'keywords')->textInput(array('rows' => 1, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'description')->textInput( array('rows' => 1, 'cols' => 50) ); ?>
    </div>

    <div class="row buttons">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php echo Html::hiddenField('type', Cms::PAGE); ?>
    <?php ActiveForm::end(); ?>

</div><!-- form -->