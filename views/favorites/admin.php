<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Favorites' => array('index'),
        'Manage',
    )
]);

echo Menu::widget([
    'items' =>array(
    array('label' => 'List Favorites', 'url' => array('index')),
    array('label' => 'Create Favorites', 'url' => array('create')),
)
]);

Yii::$app->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#favorites-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Favorites</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo Html::a('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->render('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
echo GridView::widget( array(
    'id' => 'favorites-grid',
    'dataProvider' => $model->search(),
    'filterModel' => $model,
    'columns' => array(
        'id',
        'user_id',
        'obj_id',
        'obj_type',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
