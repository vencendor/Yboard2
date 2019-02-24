<?php
/* @var $this SiteController */
/* @var $model Bulletin */

use yii\helpers\Html;


$this->context->pageTitle = Yii::$app->name;
echo Breadcrumbs::widget( array() );
$this->breadcrumbs[] = Html::encode($model->name);
?>

<table>
    <thead>
        <tr><th colspan="2"><?php echo Html::encode($model->name); ?></th></tr>
    </thead>
    <tbody>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('contact')); ?>:</td>
            <td><?php echo Html::encode($model->contact); ?></td>
        </tr>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('url')); ?>:</td>
            <td><?php echo Html::encode($model->url); ?></td>
        </tr>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('email')); ?>:</td>
            <td><?php echo Html::encode($model->email); ?></td>
        </tr>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('phone')); ?>:</td>
            <td><?php echo Html::encode($model->phone); ?></td>
        </tr>
        <?php if ($model->youtube && is_array($model->youtube)): ?>
            <?php
            /*
            foreach ($model->youtube as $youtube): ?>
                <tr class="<?php echo Yii::$app->evenness->next(); ?>">
                    <td><?php echo Html::encode($model->getAttributeLabel('youtube')); ?>:</td>
                    <td><?php $this->widget('ext.Yiitube', array('v' => $youtube, 'size' => 'small')); ?></td>
                </tr>
            <?php endforeach;
            /**/
            ?>
        <?php endif; ?>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('description')); ?>:</td>
            <td><?php echo Html::encode($model->description); ?></td>
        </tr>
        <tr class="<?php echo Yii::$app->evenness->next(); ?>">
            <td><?php echo Html::encode($model->getAttributeLabel('gallery_id')); ?>:</td>
            <td>
                <?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $model)); ?>
            </td>
        </tr>
    </tbody>
</table>