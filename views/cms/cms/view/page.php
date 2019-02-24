<?php

use yii\widgets\DetailView;

$isLink = $model->type == Cms::LINK;
echo DetailView::widget( array(
    'model' => $model,
    'attributes' => array(
        array(
            'name' => 'Link',
            'type' => 'raw',
            'value' => Html::a($model->url, !$isLink ? array("/" . $model->url) : $model->url, array(
                'target' => '_blank',
                'style' => "color:#666;font-size:11px;",
                'title' => 'View on site',
                    )
            ),
        ),
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