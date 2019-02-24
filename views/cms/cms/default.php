<?php

use yii\widgets\Breadcrumbs;

echo Breadcrumbs::widget( [
        'links' => $page->breadcrumbs
]);
?>

<h1><?php echo $page->name; ?></h1>

<p><?php echo $page->content; ?></p>