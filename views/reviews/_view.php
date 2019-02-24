<?php
/* @var $this ReviewsController */
/* @var $data Reviews */
?>

<div class="view">

    <b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo Html::a(Html::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('profile_id')); ?>:</b>
    <?php echo Html::encode($data->profile_id); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo Html::encode($data->user_id); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo Html::encode($data->type); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('review')); ?>:</b>
    <?php echo Html::encode($data->review); ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('vote')); ?>:</b>
    <?php echo Html::encode($data->vote); ?>
    <br />


</div>