<?php
/* @var $this CategoryController */
/* @var $data Category */

use yii\helpers\Html;


?>

<div class="well">

    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo Html::a(Html::encode($data->id), array('view', 'id' => $data->id)); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
                <?php echo Html::encode($data->name); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('icon')); ?>:</b>
                <?php echo Html::encode($data->icon); ?>
            </td>
        </tr>
    </table>

</div>