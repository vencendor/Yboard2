<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    'Reviews' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
) );

echo Menu::widget([
    'items' => array(
        array('label' => 'List Reviews', 'url' => array('index')),
        array('label' => 'Create Reviews', 'url' => array('create')),
        array('label' => 'View Reviews', 'url' => array('view', 'id' => $model->id)),
        array('label' => 'Manage Reviews', 'url' => array('view')),
    )
]);
?>

<h1>Update Reviews <?php echo $model->id; ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>