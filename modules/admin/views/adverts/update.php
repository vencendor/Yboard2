<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    ['label' => Yii::t('lang', 'Bulletins'), 'url' => array('index'),],
    ['label' => $model->name , 'url' => array('view', 'id' => $model->id),],
    Yii::t('lang', 'Update'),
) );

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
        array('label' => Yii::t('lang', 'Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
        array('label' => Yii::t('lang', 'View Bulletin'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
        array('label' => Yii::t('lang', 'Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    )
]);
?>

<h1><?php echo Yii::t('lang', 'Update Bulletin'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>