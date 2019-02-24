<?php
/* @var $this AnswerController */
/* @var $model Answer */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        AdminModule::t('Answers') => array('index'),
        $model->id => array('view', 'id' => $model->id),
        AdminModule::t('Update'),
    )
]);

echo Menu::widget([
    'items' => array(
        array('label' => AdminModule::t('List Answer'), 'icon' => 'icon-list', 'url' => array('index')),
        array('label' => AdminModule::t('Create Answer'), 'icon' => 'icon-plus', 'url' => array('create')),
        array('label' => AdminModule::t('View Answer'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
        array('label' => AdminModule::t('Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    )
]);
?>

<h1><?php echo AdminModule::t('Update Answer'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>