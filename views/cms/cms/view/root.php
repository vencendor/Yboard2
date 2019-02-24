<?php

use yii\widgets\DetailView;

$isLink = $model->type == Cms::LINK;
echo DetailView::widget( array(
    'model' => $model,
    'attributes' => array(
        'name',
        'content:html',
        array(
            'name' => 'Page access',
            'value' => $model->accessLevel,
        ),
        'title',
        'keywords',
        'description',
        'layout',
        'section',
        'subsection',
    ),
));
?>