<?php

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\widgets\Menu;
use yii\helpers\Html;

echo Breadcrumbs::widget( array(
    t("Users"),
) );
if (Yii::$app->user->isAdmin()) {
    $this->layout = '//main-template';
    echo Menu::widget([
            'items' =>array(
        array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/view')),
        array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('profileField/view')),
    )
    ]);
}
?>

<h1><?php echo t("List User"); ?></h1>

<?php
echo GridView::widget( array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'attribute' => 'username',
            'format' => 'raw',
            'content' => function($data){
                return Html::a(Html::encode($data->username),array("user/view","id"=>$data->id));
            } ,
        ),
        'create_at',
        'lastvisit_at',
    ),
));
?>


<?php
?>
