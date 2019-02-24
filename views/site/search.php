<?php

use yii\widgets\ListView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


echo ListView::widget( array(
    'dataProvider' => $model->search(),
    'itemView' => '_view',
));



?>