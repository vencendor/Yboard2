<?php


?>

<?php echo $form->field($model, 'type'); ?>
<?php

echo Html::activeRadioButtonList($model, 'type', array(Yii::t('bulletin', 'Demand'), Yii::t('bulletin', 'Offer')), array('labelOptions' => array('style' => 'display:inline'), 'separator' => ' ')
);
?>
<?php echo $form->field($model, 'type'); ?>