<?php


?>

<?php

echo $form->field($model, 'category_id');
echo Html::activeDropDownList($model, 'category_id', $categories, array('empty' => Yii::t('bulletin', 'Choose category'),
    'onchange' => 'loadFields(this)'));
echo $form->field($model, 'category_id');
?>