<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

echo Breadcrumbs::widget( array(
    t('Profile') => array('user', array("id" => $model->id)),
    t('Update'),
) );
?>

<h1> <?= t('Profile update') ?> </h1>

<?php echo $this->render('_form', array('model' => $model)); ?>