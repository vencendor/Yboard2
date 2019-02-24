<?php
/* @var $this MessagesController */
/* @var $model Messages */

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

echo Breadcrumbs::widget( array(
    ['label' => 'Messages' , 'url' => array('index')],
    'Create',
) );

echo Menu::widget([
    'items' => array(
        array('label' => 'List Messages', 'url' => array('index')),
        array('label' => 'Manage Messages', 'url' => array('view')),
    )
]);

//var_dump(User::findOne($receiver)->id);
?>

<div><?= t('Write messages to') ?> 
    <a href='<?= Url::to('@web/user/view', array('id' => $receiver)) ?>'>
<?= User::findOne($receiver)->username ?>
    </a>
</div>

<?php echo $this->render('_form', array('model' => $model, 'receiver' => $receiver)); ?>