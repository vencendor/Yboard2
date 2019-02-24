<?php
/* @var $this AnswerController */
/* @var $model Answer */
/** @var BootActiveForm $form */

use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use yii\helpers\Url;


echo Breadcrumbs::widget( array(
    Yii::t('main', 'Answers'),
) );
?>
<h1><?php echo Yii::t('main', 'Answers'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
));
?>

<?php
echo ListView::widget( array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>

<?php
$form = ActiveForm::begin( array(
    'id' => 'Answer',
    'action' => $this->createUrl('create'),
    'options' => array('class' => 'well'),
        ));
?>

<?php echo $form->textArea($model, 'text', array('class' => 'span3')); ?>
<br />
<?php echo Button::widget( array('buttonType' => 'submit', 'label' => Yii::t('main', 'Ask'))); ?>

<?php ActiveForm::end(); ?>

<?php ?>

