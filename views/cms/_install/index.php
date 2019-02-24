<?php

use yii\widgets\Breadcrumbs;

echo Breadcrumbs::widget([
    'links' => array(
        'Install Site Structure mosule',
    )
]);
?>
<h1>Install Site Structure module</h1>

<p>
    <?php
    if (!$installed)
        echo Html::a('Install database', array('install/installDatabase'));
    else
        echo 'Module table <b>' . $this->tableName . '</b> already exists';
    ?>
</p>

<p><?php if ($result) echo $result; ?></p>

<?php
?>

