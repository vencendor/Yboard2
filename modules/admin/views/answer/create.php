<?php
/* @var $this AnswerController */
/* @var $model Answer */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    ['label' => Yii::t('lang', 'Answers') , 'url' => array('index'),],
    Yii::t('lang', 'Create'),
) );

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'List Answer'), 'icon' => 'icon-list', 'url' => array('index')),
        array('label' => Yii::t('lang', 'Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    )
]);
?>

<h1><?php echo Yii::t('lang', 'Create Answer'); ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>