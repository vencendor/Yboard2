<?php
/* @var $this MessagesController */
/* @var $model Messages */

use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Messages' => array('index'),
        $model->id,
    )
]);

echo Menu::widget([
    'items' =>array(
    array('label' => 'List Messages', 'url' => array('index')),
    array('label' => 'Create Messages', 'url' => array('create')),
    array('label' => 'Update Messages', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Messages', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Messages', 'url' => array('view')),
)
]);
?>

<div> <?= t('View Messages') ?> <?php echo $model->id; ?></div>

<div style='border:1px solid #ccc; border-radius: 5px; padding:5px; '>
    <div> <?= $model->sender->username ?>:   </div>
    <div style='padding:20px;'> <?= $model->message ?>  </div>
    <div style='text-align:right; font-size:10px; font-style:italic; '> <?= $model->send_date ?> </div>
</div>

<?php

  echo DetailView::widget( array(
  'model'=>$model,
  'attributes'=>array(
  'id',
  'sender_id',
  'receiver_id',
  'message',
  'send_date',
  'read_date',
  ),
  ));

 /**/
?>
