<?php
/* @var $this MessagesController */
/* @var $model Messages */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
    ['label' => 'Messages' , 'url' => array('index')],
    ['label' => $model->id ,'url' => array('view', 'id' => $model->id)],
    'Update',)
]);

echo Menu::widget([
    'items' =>array(
    array('label' => 'List Messages', 'url' => array('index')),
    array('label' => 'Create Messages', 'url' => array('create')),
    array('label' => 'View Messages', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Messages', 'url' => array('view')),
)
]);
?>

<h1>Update Messages <?php echo $model->id; ?></h1>

<?php echo $this->render('_form', array('model' => $model)); ?>