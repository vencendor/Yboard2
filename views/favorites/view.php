<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Favorites' => array('index'),
        $model->id,
    )
]);

echo Menu::widget([
    'items' => array(
        array('label' => 'List Favorites', 'url' => array('index')),
        array('label' => 'Create Favorites', 'url' => array('create')),
        array('label' => 'Update Favorites', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Delete Favorites', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Favorites', 'url' => array('view')),
    )
]);
?>

<h1>View Favorites #<?php echo $model->id; ?></h1>

<?php
echo DetailView::widget(array(
    'model' => $model,
    'attributes' => array(
        'id',
        'user_id',
        'obj_id',
        'obj_type',
    ),
));
?>
