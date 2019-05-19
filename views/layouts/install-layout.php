<?php

    use yii\helpers\Html;
    use yii\helpers\Url;




?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo Html::encode($this->context->pageTitle); ?></title>
        <link href="<?php echo Url::base(); ?>/css/main_style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo Url::base(); ?>/js/yboard.js" ></script>
        <link href="<?php echo Url::base(); ?>/css/main_style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link id="page_favicon" href="favicon.png" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <?php $this->head() ?>
    </head>

    <body>
        <div id='header'>
            <div id="topheader">
                <a href='<?php echo Url::base(); ?>' class="logo">Доска объявлений на Yii</a>
                <div class="menu_area">
                    Установка
                </div>
            </div>
        </div>
        <div id='content'>
            <div id="body_area">
                <?php echo $content; ?>
                <br style='clear:both' />
            </div>
        </div>
        <div id="fotter">
            <div class="fotter_links">
                <div align="center"><a href="#" class="fotterlink">Home</a>  |  <a href="#" class="fotterlink">About Us</a>  |  <a href="#" class="fotterlink">Companies Success</a>  |  <a href="#" class="fotterlink">Client Testimonials</a>  |  <a href="#" class="fotterlink">Methods of Development</a>  |  <a href="#" class="fotterlink">Newsletter</a>  |  <a href="#" class="fotterlink">Subscribe Info</a>  |  <a href="#" class="fotterlink">Oppotunities</a>  |  <a href="#" class="fotterlink">Current Events</a>  |  <a href="#" class="fotterlink">Contact Us</a></div>
            </div>
            <div class="fotter_copyrights">
                <div align="center">&copy; Copyright Information Goes Here. All Rights Reserved</div>
            </div>
            <div class="fotter_validation">
                <div align="center"><a href="http://validator.w3.org/check?uri=referer" target="_blank" class="xhtml">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="css">CSS</a><br />
                </div>
            </div>
            <div class="fotter_designed">
                <div align="center">Designed By : <a href="#" class="fotter_designedlink">Template World</a></div>
            </div>
        </div>


    </body>
</html>
