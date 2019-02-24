<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $user User */

use yii\widgets\ActiveForm;

$this->context->pageTitle = Yii::$app->name . ' - Обратная связь';
/*
  $this->breadcrumbs=array(
  'Обратная связь',
  );
 */
echo Breadcrumbs::widget( array(
    'links' => array('', 'Обратная связь'),
));
?>

<h1>Отправить сообщение <?php echo $user ? $user->username : 'администратору'; ?></h1>

<?php if (Yii::$app->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::$app->session->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>

    </p>

    <div class="form">


        <?php
        $form = ActiveForm::begin( array(
            'id' => 'verticalForm',
            'options' => array('class' => 'well'),
        ));
        ?>


        <p class="note">Поля, обязательные для заполнения, помечены звездочкой (<span class="required">*</span>).</p>

        <?php echo $form->errorSummary($model); ?>

        <div >
            <?php echo $form->field($model, 'name')->textInput(); ?>
        </div>

        <div >
            <?php echo $form->field($model, 'email')->textInput(); ?>
        </div>

        <div >
            <?php echo $form->field($model, 'subject', array('size' => 60, 'maxlength' => 128))->textInput(); ?>
        </div>

        <div >
            <?php echo $form->field($model, 'body', array('rows' => 6, 'cols' => 50))->textarea(); ?>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div >
                <?php echo $form->field($model, 'verifyCode')->textInput(); ?>
                <div>
                    <?php echo Captcha::widget(); ?>
                    <?php echo $form->field($model, 'verifyCode')->textInput(); ?>
                </div>
                <div class="hint">Пожалуйста, введите буквы, показанные на картинке выше.
                    <br/>Регистр значение не имеет.</div>
                <?php echo $form->field($model, 'verifyCode')->textInput(); ?>
            </div>
        <?php endif; ?>

        <?php echo Button::widget( array('buttonType' => 'submit', 'label' => 'Отправить')); ?>

        <?php ActiveForm::end(); ?>
    </div><!-- form -->

<?php endif; ?>