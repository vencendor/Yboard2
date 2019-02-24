<?php
/* @var $this CategoryController */
/* @var $model Category */

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\widgets\Menu;
use yii\helpers\Url;

echo Breadcrumbs::widget( array(
    ['label' => Yii::t('lang', 'Categories') , 'url' => array('index')],
    Yii::t('lang', 'Manage'),
) );

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'List Category'), 'icon' => 'icon-list', 'url' => array('index'), "itemOptions" => array('class' => 'btn')),
        array('label' => Yii::t('lang', 'Create Category'), 'icon' => 'icon-plus', 'url' => array('create'), "itemOptions" => array('class' => 'btn')),
    )
]);

Yii::$app->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo Html::a(t('Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->render('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
echo GridView::widget( array(
    'type' => 'striped bordered condensed',
    'id' => 'category-grid',
    'dataProvider' => $model->search(),
    'filterModel' => $model,
    'columns' => array(
        'id',
        'name',
        'icon',
        'level',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'options' => array('style' => 'width: 50px'),
        ),
    ),
));
?>
