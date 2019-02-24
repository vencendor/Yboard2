<?

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Adverts;
use yii\helpers\VarDumper;

/* @var $this AdvertsController */
/* @var $model Adverts */



?>


<div class=" well advertList">
    <div style='float:left; width: 95px; height: 60px; overflow:hidden;'>
        <? 
        
        if( false ){ /// ------------- HACK -*---------------
         /*
        if ($model->gallery && $model->gallery->galleryPhotos) { ?>
            <?
            echo newerton\fancybox\FancyBox::widget( array(
                'config' => array(),
                    )
            );

            
            
           
            foreach ($model->gallery->galleryPhotos as $model_photo) { ?>
                <a href="<? echo $model_photo->getUrl(); ?>" class="fancybox" rel="<? echo Html::encode($model->id) ?>">
                    <img src="<? echo $model_photo->getPreview(); ?>" 
                         style='max-width:95px; max-height:60px;' alt="<? echo Html::encode($model->name) ?>" />
                </a>
            <? }
            
            /**/
        } else {
            ?>
            <a href="<?= Url::to(['adverts/view','id' => $model->id])
            ?>" class="fancybox" rel="<? echo Html::encode($model->id) ?>">
                <img src="<? echo Url::base() . "/gallery/noimage.gif"; ?>" 
                     style='max-width:95px; max-height:60px;' alt="<? echo Html::encode($model->name) ?>" />
            </a>
<? } ?>
    </div>
    <div style='margin-left:100px'>
        <div>
            <? echo Html::a(Html::encode($model->name), array('adverts/view', 'id' => $model->id)); ?>
               <? if ($model->user_id == Yii::$app->user->id and Yii::$app->user->id) { ?>
                <a href='<?= Url::to('@web/adverts/update', array('id' => $model->id))
                   ?>' class='redact'> редактировать <?= Yii::$app->user->id ?></a>
<? } ?>
        </div>
        <div><? echo Html::encode(mb_substr($model->text, 0, 220)); ?></div>
    </div>

</div>