<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    'Favorites' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
) );

echo Menu::widget([
    'items' => array(
        array('label' => 'List Favorites', 'url' => array('index')),
        array('label' => 'Create Favorites', 'url' => array('create')),
        array('label' => 'View Favorites', 'url' => array('view', 'id' => $model->id)),
        array('label' => 'Manage Favorites', 'url' => array('view')),
    )
]);
?>

<h1>Update Favorites <?php echo $model->id; ?></h1>

<?php $this->render('_form', array('model' => $model)); ?>