<?php

use yii\helpers\Html;

foreach ($list as $row):

    echo Html::a($row['loc'], $row['loc']);
    echo Html::tag('br');

endforeach;
?>
