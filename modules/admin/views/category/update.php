<?php
/* @var $this CategoryController */
/* @var $model Category */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    ['label' => Yii::t('lang', 'Categories'), 'url' => array('index')],
    ['label' => $model->name , 'url' => array('view', 'id' => $model->id) ],
    Yii::t('lang', 'Update'),
) );

echo Menu::widget([
    'items' =>array(
    array('label' => Yii::t('lang', 'List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang', 'Create Category'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang', 'View Category'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('lang', 'Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    array('label' => Yii::t('lang', 'Удалить категорию'), 'icon' => 'icon-folder-open', 'url' => array('/view/category/delete', 'id' => $model->id)),
)
]);
?>

<h1><?php echo Yii::t('lang', 'Update Category'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>