<?php
/* @var $this BulletinController */
/* @var $data Bulletin */

use yii\helpers\Html;

?>

<div class="well">
    <div style='float:left; width: 150px; height: 100px; overflow:hidden;'>
        <?php if ($data->gallery && $data->gallery->galleryPhotos) { ?>
            <?php
            echo newerton\fancybox\FancyBox::widget( array(
                'config' => array(),
                    )
            );
            ?>
            <?php foreach ($data->gallery->galleryPhotos as $model) { ?>
                <a href="<?php echo $model->getUrl(); ?>" class="fancybox" rel="<?php echo Html::encode($data->id) ?>">
                    <img src="<?php echo $model->getPreview(); ?>" width="150" alt="<?php echo encode($data->name) ?>" />
                </a>
            <?php }
        }
        ?>
    </div>
    <div style='margin-left:160px'>
        <div><?php echo Html::a(Html::encode($data->name), array('site/bulletin', 'id' => $data->id)); ?></div>
        <div><?php echo Html::encode($data->text); ?></div>
        <div>
            <?php echo $data->itemAlias('type', $data->type); ?> 
            <?php echo Html::a(Html::encode($data->user->username), array('user/user/view', 'id' => $data->user->id)); ?>
        </div>
    </div>
    <table class="table" style='display:none'>
        <tr class="alert-info">
            <td><b><?php echo Html::encode($data->getAttributeLabel('type')); ?>:</b>

            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>

            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>

            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo Html::encode($data->getAttributeLabel('gallery_id')); ?>:</b>

            </td>
        </tr>
        <tr class="alert-block">
            <td>  <b><?php echo Html::encode($data->getAttributeLabel('text')); ?>:</b>

            </td>
        </tr>
    </table>
</div>