<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    'Favorites' => array('index'),
    'Create',
) );

echo Menu::widget([
    'items' => array(
        array('label' => 'List Favorites', 'url' => array('index')),
        array('label' => 'Manage Favorites', 'url' => array('view')),
    )
]);
?>

<h1>Create Favorites</h1>

<?php $this->render('_form', array('model' => $model)); ?>