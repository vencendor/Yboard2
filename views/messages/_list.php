<?php
/* @var $this MessagesController */
/* @var $data Messages */

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="view mes_list">


    <i class='mesDate' style='float:right; font-size:12px; '>
        <?php echo PeopleDate::format($data['last_date']); ?>
    </i>

    <a href='<? echo Url::to('@web/messages/dialog', array('user' => $data['interlocutor'])); ?>'> <b><?php echo Html::encode($data['username']); ?></b> </a>
    <br/>
    Сообщений (<?php echo Html::encode($data['count_mes']); ?>)

</div>