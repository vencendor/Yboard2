<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Adverts;
use yii\widgets\ListView;
use yii\helpers\VarDumper;

/* @var $this SiteController */
/* @var $model Category */

$this->context->pageTitle = Yii::$app->name;

/*
echo Breadcrumbs::widget( array();
if ($model->parent)
    $this->breadcrumbs[$model->parent->name] = array('site/category', 'id' => $model->parent->id);
$this->breadcrumbs[] = Html::encode($model->name);
/**/
?>

<h3>Категория "<?= Html::encode($model->name) ?>"</h3>

<?php


    ListView::widget( array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
) );
?>

