<?php
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Cms',
    )
]);

echo Menu::widget([
    'items' => array(
        array('label' => 'Create Cms', 'url' => array('create')),
        array('label' => 'Manage Cms', 'url' => array('view')),
    )
]);
?>

<h1>Cms</h1>

<?php
echo ListView::widget( array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>


<?php ?>

