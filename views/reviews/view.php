<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Reviews' => array('index'),
        $model->id,
    )
]);

echo Menu::widget([
    'items' =>array(
    array('label' => 'List Reviews', 'url' => array('index')),
    array('label' => 'Create Reviews', 'url' => array('create')),
    array('label' => 'Update Reviews', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Reviews', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Reviews', 'url' => array('view')),
)
]);
?>

<h1>View Reviews #<?php echo $model->id; ?></h1>

<?php
echo DetailView::widget( array(
    'model' => $model,
    'attributes' => array(
        'id',
        'profile_id',
        'user_id',
        'type',
        'review',
        'vote',
    ),
));
?>
