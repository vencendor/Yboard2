<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->context->pageTitle = Yii::$app->name . ' - Error';
echo Breadcrumbs::widget([
    'links' => [
        [ 'Error', ]
    ]
]);
?>

<h2>Error <?php echo $error->exception->statusCode; ?></h2>

<div class="error">
    <?php echo Html::encode($error->exception->getMessage()); ?>
</div>