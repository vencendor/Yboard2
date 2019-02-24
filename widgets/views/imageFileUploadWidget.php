<?php

/* @var $form CActiveForm */
/* @var $model CModel */
?>

<?php echo $form->field($model, $attribute); ?>
<?php if ($preview): ?>
    <img src="<?php echo $preview; ?>" alt="<?php echo $attribute; ?>" />
<?php endif; ?>
<?php echo $form->fileField($model, $attribute); ?>
<?php echo $form->field($model, $attribute); ?>

