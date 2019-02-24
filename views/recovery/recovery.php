<?php
$this->context->pageTitle = Yii::$app->name . ' - ' . t("Restore");
echo Breadcrumbs::widget( array(
    t("Login") => array('/user/login'),
    t("Restore"),
) );
?>

<h1><?php echo t("Restore"); ?></h1>

<?php if (Yii::$app->user->hasFlash('recoveryMessage')): ?>
    <div class="success">
        <?php echo Yii::$app->session->getFlash('recoveryMessage'); ?>
    </div>
<?php else: ?>

    <div class="form">
        <?php echo Html::beginForm(); ?>

        <?php echo Html::errorSummary($form); ?>

        <div class="row">
            <?php echo Html::activeLabel($form, 'login_or_email'); ?>
            <?php echo Html::activeTextInput($form, 'login_or_email') ?>
            <p class="hint"><?php echo t("Please enter your login or email addres."); ?></p>
        </div>

        <div class="row submit">
            <?php echo Html::submitButton(t("Restore")); ?>
        </div>

        <?php echo Html::endForm(); ?>
    </div><!-- form -->
<?php endif; ?>