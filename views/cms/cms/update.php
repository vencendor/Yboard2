<?php

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        'Cms' => array('index'),
        $model->name => array('view', 'id' => $model->id),
        'Update',
    )
] );

echo Menu::widget([
    'items' =>array(
    array('label' => t('View') . " " . $model->name, 'url' => array('view', 'id' => $model->id)),
    array('label' => t('List pages'), 'url' => array('index')),
)
]);
?>

<h1><?= t('Update') ?> <?php echo $model->name; ?></h1>

<?php echo $this->render('forms/' . $this->getFormPartial($model), array('model' => $model)); ?>