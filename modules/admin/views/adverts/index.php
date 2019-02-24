<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\widgets\Menu;

echo Breadcrumbs::widget( /*
        array(
    Yii::t('lang', 'Bulletins') => array('index'),
    Yii::t('lang', 'Manage'),
)*/
 );

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'List Bulletin'), 'icon' => 'icon-list', 'url' => array('index'), "itemOptions" => array('class' => 'btn')),
        array('label' => Yii::t('lang', 'Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create'), "itemOptions" => array('class' => 'btn')),
    )
]);

Yii::$app->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bulletin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>




<h1><?php echo t('Manage Bulletins'); ?></h1>



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
    'id' => 'bulletin-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(// display 'create_time' using an expression
            'class' => 'CLinkColumn',
            'header' => t('name'),
        ),
        array(// display 'create_time' using an expression
            'class' => 'CLinkColumn',
            'header' => t('user_id'),
        ),
        array(
            'class' => 'CLinkColumn',
            'header' => t('moderated'),
        ),
        array(
            'value' => '$data->category->name',
        ),
        'views',
        /*
          'text',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>


<script>

    $('a.moder').click(function (e) {
    e.preventDefault();
            $.get($(this).attr('href').toString(), function (data) {
            if (data == "ok")
            }
            $(this).parent().html("Отмодереровано");
                    );
    });

</script>

