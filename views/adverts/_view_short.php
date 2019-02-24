<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;

// dump( $model );

//$model = $model->gallery->galleryPhotos[0];


?>

<a href="<?= Url::to('@web/adverts/view', array('id' => $model->id))
?>" class="fancybox" rel="<? echo Html::encode($model->id) ?>">
   <? if ( $model->getPhoto() ) { ?>
        <img src="<? echo $model->getPhoto(); ?>" <
             style='max-width:95px; max-height:60px;' alt="<? echo Html::encode($data->name) ?>" />

    <? } ?>
    <?= $model->name ?>
</a>