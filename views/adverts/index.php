<?php

/* @var $this SiteController */

use yii\widgets\ListView;

$this->context->pageTitle = Yii::$app->name;

if (!$data) {
    echo "<div class='results'>" . t("No results for full search. Show simplified search results:") . "</div>";
}

echo ListView::widget( array(
    'dataProvider' => $data,
    'itemView' => '_view',
    'ajaxUpdate' => false,
));
?>

