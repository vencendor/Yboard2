<?php
$this->context->pageTitle = Yii::$app->name . ' - ' . t("Change Password");
echo Breadcrumbs::widget( array(
    t("Login") => array('/user/login'),
    t("Change Password"),
) );
?>

<h1><?php echo t("Change Password"); ?></h1>


<div class="form">
<?php echo Html::beginForm(); ?>

    <p class="note"><?php echo t('Fields with <span class="required">*</span> are required.'); ?></p>
<?php echo Html::errorSummary($form); ?>

    <div class="row">
        <?php echo Html::activeLabelEx($form, 'password'); ?>
            <?php echo Html::activePasswordField($form, 'password'); ?>
        <p class="hint">
<?php echo t("Minimal password length 4 symbols."); ?>
        </p>
    </div>

    <div class="row">
        <?php echo Html::activeLabelEx($form, 'verifyPassword'); ?>
<?php echo Html::activePasswordField($form, 'verifyPassword'); ?>
    </div>


    <div class="row submit">
<?php echo Html::submitButton(t("Save")); ?>
    </div>

<?php echo Html::endForm(); ?>
</div><!-- form -->