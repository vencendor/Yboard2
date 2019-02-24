<?php
/* @var $this BulletinController */
/* @var $dataProvider ActiveDataProvider */

use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget([
    'links' => array(
        Yii::t('lang', 'Bulletins'),
    )
]);

echo Menu::widget([
    'items' => array(
        array('label' => Yii::t('lang', 'Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
        array('label' => Yii::t('lang', 'Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('view')),
    )
]);
?>

<h1><?php echo Yii::t('lang', 'Bulletins'); ?></h1>

<table>
        <th>
        <td><?php echo Html::encode($data->getAttributeLabel('id')); ?></td>
        <td><b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
            <?php echo Html::encode($data->name); ?>
        </td>

        <td><b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
            <?php echo Html::encode($data->user_id); ?>
        </td>

        <td><b><?php echo Html::encode($data->getAttributeLabel('moderated')); ?>:</b>
            <?php echo Html::encode($data->moderated); ?>
        </td>

        <td><b><?php echo Html::encode($data->getAttributeLabel('category_id')); ?>:</b>
            <?php echo Html::encode($data->category_id); ?>
        </td>

        <td><b><?php echo Html::encode($data->getAttributeLabel('type')); ?>:</b>
            <?php echo Html::encode($data->type); ?>
        </td>

        <td><b><?php echo Html::encode($data->getAttributeLabel('views')); ?>:</b>
            <?php echo Html::encode($data->views); ?>
        </td>
        <td><b><?php echo Html::encode($data->getAttributeLabel('text')); ?>:</b>
            <?php echo Html::encode($data->text); ?>
        </td>
        </th>
        <?php
        echo ListView::widget( array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
        ));
        ?>
</table>

