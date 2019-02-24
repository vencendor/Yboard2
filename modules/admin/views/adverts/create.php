<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    Yii::t('lang', 'Bulletins') => array('index'),
    Yii::t('lang', 'Create'),
) );

echo Menu::widget([
    'items' =>array(
    array('label' => Yii::t('lang', 'List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang', 'Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('view')),
)
]);
?>

<h1><?php echo Yii::t('lang', 'Create Bulletin'); ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>