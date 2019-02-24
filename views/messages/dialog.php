<?php
/* @var $this MessagesController */
/* @var $dataProvider ActiveDataProvider */
/* @var $userData ActiveRecord User */
/* @var $model ActiveRecord Messages */

use yii\widgets\ListView;

?>

<h4><?= t('Dialog') ?> с 
    <a href='<? echo Url::to('@web/user/view/', array('id' => $userData->id)) ?>'>
        <?= $userData->username ?></a>
</h4>

<div class='dialog'>
    <?php
    echo ListView::widget( array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ));
    ?>
</div>

<?php echo $this->render('_form', array('model' => $model, 'receiver' => $userData->id)); ?>