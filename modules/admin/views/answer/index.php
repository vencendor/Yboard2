<?php
/* @var $this AnswerController */
/* @var $dataProvider ActiveDataProvider */

use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Menu;


echo Breadcrumbs::widget([
       'links' =>  array(
    Yii::t('lang', 'Answers'),
)
]);

echo Menu::widget([
    'items' =>array(
    array('label' => Yii::t('lang', 'Create Answer'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang', 'Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('view')),
)
]);
?>

<h1><?php echo Yii::t('lang', 'Answers'); ?></h1>

<?php
echo ListView::widget( array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>


<?php
?>
