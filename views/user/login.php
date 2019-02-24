<?php


use rmrevin\yii\ulogin\ULogin;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\widgets\ActiveForm;


$this->context->pageTitle = Yii::$app->name . ' - ' . t("Login");
echo Breadcrumbs::widget([
    "links" => [
        t("Login"),
    ],
]);
?>

<h1><?php echo t("Login"); ?></h1>

<?php if (Yii::$app->session->getFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::$app->session->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>


<div class="form well">
    <h3><?= t('Social networks authorisation :') ?></h3>





    <?
    echo ULogin::widget([
        // widget look'n'feel
        'display' => ULogin::D_PANEL,

        // required fields
        'fields' => [ULogin::F_FIRST_NAME, ULogin::F_LAST_NAME, ULogin::F_EMAIL, ULogin::F_PHONE, ULogin::F_CITY, ULogin::F_COUNTRY, ULogin::F_PHOTO_BIG],

        // optional fields
        'optional' => [ULogin::F_BDATE],

        // login providers
        'providers' => [ULogin::P_VKONTAKTE, ULogin::P_FACEBOOK, ULogin::P_TWITTER, ULogin::P_GOOGLE],

        // login providers that are shown when user clicks on additonal providers button
        'hidden' => [],

        // where to should ULogin redirect users after successful login
        'redirectUri' => Url::base() . '/index.php?r=login/ulogin',

        // force use https in redirect uri
        'forceRedirectUrlScheme' => 'https',

        // optional params (can be ommited)
        // force widget language (autodetect by default)
        'language' => ULogin::L_RU,

        // providers sorting ('relevant' by default)
        'sortProviders' => ULogin::S_RELEVANT,

        // verify users' email (disabled by default)
        'verifyEmail' => '0',

        // mobile buttons style (enabled by default)
        'mobileButtons' => '1',
    ]);
    ?>

    <hr/>
    <h3><?= t('Authorisation for members:') ?></h3>

    <?php echo Html::beginForm(); ?>

    <?php echo Html::errorSummary($model); ?>

    <div >
        <?php echo Html::activeLabel($model, 'username'); ?>
        <?php echo Html::activeTextInput($model, 'username') ?>
    </div>

    <div >
        <?php echo Html::activeLabel($model, 'password'); ?>
        <?php echo Html::activePasswordInput($model, 'password') ?>
    </div>

    <div class=" rememberMe">
        <?php echo Html::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo Html::activeLabel($model, 'rememberMe'); ?>
    </div>

    <div >
        <p class="hint">
            <?php echo Html::a(t("Register"), Yii::$app->getModule('user')->registrationUrl); ?> | <?php echo Html::a(t("Lost Password?"), Yii::$app->getModule('user')->recoveryUrl); ?>
        </p>
    </div>



    <div class=" submit">
        <?php echo Html::submitButton( t('Вход')); ?>

    </div>

    <?php echo Html::endForm(); ?>
</div><!-- form -->