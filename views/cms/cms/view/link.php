<?php

use yii\widgets\DetailView;

$isLink = $model->type == Cms::LINK;
echo DetailView::widget( array(
    'model' => $model,
    'attributes' => array(
        array(
            'name' => 'Link label',
            'value' => $model->name,
        ),
        array(
            'name' => 'Url',
            'type' => 'raw',
            'value' => Html::a($model->url, !$isLink ? array("/" . $model->url) : $model->url, array(
                'target' => '_blank',
                'style' => "color:#666;font-size:11px;",
                'title' => 'Follow link',
                    )
            ),
        ),
    ),
));
?>