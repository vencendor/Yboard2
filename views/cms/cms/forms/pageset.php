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
        <div id="translit"></div>
    </div>

    <?php
    $this->publishJS();
    $this->initTranslit();
    ?>

    <div class="row">
        <?php echo $form->field($model, 'access_level'); ?>
        <?php echo $form->dropDownList($model, 'access_level', $model->getAccessLevels()); ?>
        <?php echo $form->field($model, 'access_level'); ?>
    </div>

    <div class="row">
        <?php echo $form->field($model, 'overview_page', array('style' => 'display:inline;')); ?>
        <?php
        echo $form->checkBox($model, 'overview_page', array(
            'onclick' => 'js:jQuery("#tpls").toggle();',
            'style' => 'display:inline;'));
        ?>
<?php echo $form->field($model, 'overview_page'); ?>
    </div>

    <div id="tpls" style="display:<?php echo $model->overview_page ? 'block' : 'none' ?>">

        <table style="width:auto;margin:0;">
            <tr>
                <td>
                    <?php echo $form->field($model, 'layout'); ?>
                    <?php echo $form->dropDownList($model, 'layout', $model->layouts, array('empty' => ''));
                    ?>
                    <?php echo $form->field($model, 'layout'); ?>
                </td>
                <td>                 
                    <?php echo $form->field($model, 'section'); ?>
                    <?php echo $form->dropDownList($model, 'section', $model->sections, array('empty' => ''));
                    ?>
                    <?php echo $form->field($model, 'section'); ?>
                </td>
                <td>                                                    
                    <?php echo $form->field($model, 'subsection'); ?>
                    <?php echo $form->dropDownList($model, 'subsection', $model->subsections, array('empty' => ''));
                    ?>
<?php echo $form->field($model, 'subsection'); ?>
                </td>
            </tr>
        </table>

        <div class="row">
            <?php echo $form->field($model, 'content'); ?>
            <?php
            if ($this->FckEditorAvailable(0)) {
                $this->widget('application.extensions.ckeditor.CKEditor', array(
                    'model' => $model,
                    'attribute' => 'content',
                    //'language'=>'ru',
                    'editorTemplate' => 'full', //'basic',
                    'skin' => 'v2'
                ));
            } else
                echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 50));
            ?>
        </div>

        <div class="row">
            <?php echo $form->field($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->field($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->field($model, 'keywords'); ?>
<?php echo $form->textArea($model, 'keywords', array('rows' => 1, 'cols' => 50)); ?>
<?php echo $form->field($model, 'keywords'); ?>
        </div>

        <div class="row">
            <?php echo $form->field($model, 'description'); ?>
<?php echo $form->textArea($model, 'description', array('rows' => 1, 'cols' => 50)); ?>
<?php echo $form->field($model, 'description'); ?>
        </div>

    </div>

    <div class="row buttons">
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
<?php echo Html::hiddenField('type', Cms::PAGESET); ?>
<?php ActiveForm::end(); ?>

</div><!-- form -->