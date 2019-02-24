<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */

/* @var $categories array */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use yii\bootstrap\Button;
use zxbodya\yii2\galleryManager\GalleryManager;


?>

<div class="form well">

    <?php
    $form = ActiveForm::begin(array(
        'id' => 'bulletin-form',
        'enableAjaxValidation' => false,
        'options' => array('enctype' => 'multipart/form-data'),
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>



    <div>
        <?php if (isset($_POST['Adverts']['name']) or $model->name) { ?>
            <div>
                <?php echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::findAll([]), "id", "name"), array('empty' => t('Choose category'))); ?>

            </div>
        <?php } else { ?>
            <?php echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::roots(), "id", "name"), array('empty' => t('Choose category'), 'onchange' => 'loadFields(this)'));
        }
        ?>

        <div class='ajax-div'></div>
    </div>

    <div id='bulletin_form' <?php echo (isset($_POST['Adverts']['name']) or $model->name) ? "" : "style='display:none;'" ?> >


        <div>
            <script>

                $("#locationName").autocomplete({
                    source: baseUrl + "/site/location_list",
                    minLength: 2,
                    select: function (event, ui) {
                        $("#location").val(ui.item.id);
                    }
                });

            </script>
            <?
            echo Html::input('text', 'locationName', $_POST['locationName'] ? $_POST['locationName'] : $loc['name']);
            echo Html::input('hidden', 'location', $loc['id']);
            ?>
        </div>

        <div>
            <?php echo $form->field($model, 'name')->textInput(array('maxlength' => 255)); ?>
        </div>

        <div>
            <?php echo $form->field($model, 'text')->textarea(array('rows' => '6')); ?>

        </div>

        <?php
        /*
          <div >
          <?php  echo $form->field($model, 'type'); ?>
          <?php
          echo Html::activeRadioButtonList($model, 'type', array(
          t('Demand'), t('Offer')), array(
          'labelOptions' => array(
          'style' => 'display:inline'), 'separator' => ' '));
          ?>
          <?php echo $form->field($model, 'type'); ?>
          </div>
         * 
         */
        ?>
        <div>
            <?php echo Html::checkBox('no_price', $model->price == 0 ? true : false, array('onclick' => 'hide_price()')); ?>
        </div>
        <div class='price'>
            <?php echo $form->field($model, 'price')->radio(array('disabled' => $model->price == 0 ? 'disabled' : "")); ?>
            <?php echo $form->field($model, 'price')->radio(array('disabled' => $model->price == 0 ? 'disabled' : "")); ?>
            <?php echo $form->field($model, 'currency')->dropDownList($this->context->settings['currency']); ?>
        </div>

        <div>
            <?

            if ( !$model->isNewRecord ) {
                echo GalleryManager::widget(
                    [
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'adverts/galleryApi'
                    ]
                );
            }

            ?>
        </div>

        <div class="row buttons" align='center'>
            <?php echo Html::submitButton('Отправить'); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- form -->


