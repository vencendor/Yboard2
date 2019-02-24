<?php
/* @var $this CategoryController */
/* @var $model Category */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    ['label' => Yii::t('lang', 'Categories') , 'url' => array('index')],
    Yii::t('lang', 'Create'),
) );

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'List Category'), 'icon' => 'icon-list', 'url' => array('index')),
        array('label' => Yii::t('lang', 'Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    )
]);
?>

<h1><?php echo Yii::t('lang', 'Create Category'); ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>