<?php
/* @var $this FavoritesController */
/* @var $data Favorites */
?>

<div class="view">

    <b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo Html::a(Html::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo Html::encode($data->user_id); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('obj_id')); ?>:</b>
    <?php echo Html::encode($data->obj_id); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('obj_type')); ?>:</b>
    <?php echo Html::encode($data->obj_type); ?>
    <br />


</div>