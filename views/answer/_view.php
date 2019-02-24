<?php
/* @var $this AnswerController */
/* @var $data Answer */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="view">

    <b><?php echo Html::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo $data->user ? Html::a(Html::encode($data->user->username), array('user/user/view', 'id' => $data->user->id)) : ''; ?>
    <br />

    <b><?php echo Html::encode($data->getAttributeLabel('text')); ?>:</b>
    <?php echo Html::encode($data->text); ?>
    <br />

    <?php if (!empty($data->answers)): ?>
        <?php foreach ($data->answers as $answer): ?>
            <div class="answer well">
                <?php echo Html::encode($answer->text); ?>
            </div>
        <?php endforeach; ?>
    <?php elseif ($this->canUserReply()): ?>
        <?php
        $form = ActiveForm::begin( array(
            'id' => 'Answer',
            'action' => $this->createUrl('create'),
            'options' => array('class' => 'well'),
        ));
        ?>

        <?php echo Html::textArea('Answer[text]', '', array('class' => 'span3')); ?>
        <?php echo Html::hiddenField('Answer[parent_id]', $data->id); ?>
        <br />
        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => Yii::t('main', 'Reply'))); ?>
        <?php ActiveForm::end(); ?>

<?php endif; ?>

</div>