<?php

/* @var $bulletin Bulletin */
/* @var $model GalleryPhoto */
?>

<?php if ($bulletin->gallery && $bulletin->gallery->galleryPhotos): ?>
    <?php
    echo newerton\fancybox\FancyBox::widget( array(
        'config' => array(),
            )
    );
    ?>
    <?php foreach ($bulletin->gallery->galleryPhotos as $model): ?>
        <a href="<?php echo $model->getUrl(); ?>" class="fancied" rel="<?php echo Html::encode($bulletin->id) ?>">
            <img src="<?php echo $model->getPreview(); ?>" width="150" alt="<?php echo Html::encode($bulletin->name) ?>" />
        </a>
    <?php endforeach; ?>
<?php endif; ?>
