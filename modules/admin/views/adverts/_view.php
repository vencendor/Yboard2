<?php
/* @var $this BulletinController */
/* @var $data Bulletin */
?>


<tr class="alert-info">
    <td><b><?php echo Html::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo Html::a(Html::encode($data->id), array('view', 'id' => $data->id)); ?>
    </td>
    <td><b><?php echo Html::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo Html::encode($data->name); ?>
    </td>

    <td><b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
        <?php echo Html::encode($data->user_id); ?>
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
</tr>
