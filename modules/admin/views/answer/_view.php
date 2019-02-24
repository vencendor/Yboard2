<?php
/* @var $this AnswerController */
/* @var $data Answer */
?>

<div class="view well">
    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo Html::a(Html::encode($data->id), array('view', 'id' => $data->id)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('parent_id')); ?>:</b>
                <?php echo Html::encode($data->parent_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
                <?php echo Html::encode($data->user_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('text')); ?>:</b>
                <?php echo Html::encode($data->text); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('created_at')); ?>:</b>
                <?php echo Html::encode($data->created_at); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo Html::encode($data->getAttributeLabel('updated_at')); ?>:</b>
                <?php echo Html::encode($data->updated_at); ?>
            </td>
        </tr>
    </table>

</div>