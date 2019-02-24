<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->context->pageTitle = Yii::$app->name . ' - Настройки';
echo Breadcrumbs::widget( array(
    'Настройки',
) );
?>

<h1>Настройки</h1>

<?php
\app\components\configer\Configer::widget( array(
    'configPath' => $configPath
) );
?>
