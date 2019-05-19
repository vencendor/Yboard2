<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use yii\widgets\ActiveForm;
use yii\bootstrap4\Button;
use yii\helpers\Html;

?>


<?php
$form = ActiveForm::begin( array(
    'id' => 'verticalForm',
    'options' => array('class' => 'well'),
        ));
?>

<h1> Установка Ybord </h1>

<?php echo $form->errorSummary($model); ?>
<p style='color:#ff0000; padding:15px; '><?= $db_error ?></p>


<fieldset>
    <label> Данные создаваемого проекта </label>
    <div class='install_blocks' >
        <?php echo $form->field($model, 'site_name')->textInput(); ?>
    </div>
</fieldset>


<fieldset>
    <label> Данные администратора </label>
    <div class='install_blocks' >
        <?php echo $form->field($model, 'username')->textInput(); ?>

        <?php echo $form->field($model, 'userpass')->textInput(); ?>


        <?php echo $form->field($model, 'userpass2')->textInput(); ?>

        <?php echo $form->field($model, 'useremail')->textInput(); ?>
    </div>
</fieldset>

<fieldset>
    <label> Данные для подключения к базе данных </label>
    <div  class='install_blocks' >
        <?php echo $form->field($model, 'mysql_server')->textInput(); ?>

        <?php echo $form->field($model, 'mysql_db_name')->textInput(); ?>

        <?php echo $form->field($model, 'mysql_login')->textInput(); ?>

        <?php echo $form->field($model, 'mysql_password')->textInput(); ?>
    </div>
</fieldset>

<br/>



<?php echo Html::submitButton('Отправить'); ?>


<?php ActiveForm::end(); ?>