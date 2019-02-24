<?php 
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;
use yii\widgets\ListView;
use app\models\Category;

$this->beginPage();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="description" content="<?php echo $this->context->meta_description(); ?>" />

        <script> baseUrl = '<?= Url::base() ?>';</script>


        <script src="<?php echo Url::base(); ?>/js/yboard.js" ></script>
        <link href="<?php echo Url::base(); ?>/css/main_style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link id="page_favicon" href="favicon.png" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <?
        //echo Html::a("Ожидает", array("/view/adverts/update", "id" => $data->id ), array("target"=>"_blank")  );
        ?>

        <div id='header'>
            <div id="topheader">
                <a href='<?= Url::base() ?>' class="logo">Доска объявлений на Yii</a>
                <div class="menu_area">
                    <div class='ideas'>
                        <a href="<?= Url::to("@web/adverts") ?>" class="general">Объявления</a>
                        <a href='<?= Url::to("@web/adverts/create") ?>' class="menu_text">
                            <i class='fa fa-plus'></i>добавить
                        </a>
                    </div>
                    <?php
                    echo Menu::widget(array(
                        'encodeLabels' => false,
                        'items' => array(
                            array('url' => Url::to("@web/login"),
                                'label' => "<i class='fa fa-sign-in'></i>" . t("Login"),
                                'visible' => Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to("@web/registration"),
                                'label' => "<i class='fa fa-user-plus'></i>" . t("Register"),
                                'visible' => Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to('@web/user/' . Yii::$app->user->id),
                                'label' => "<i class='fa fa-user'></i>" . t("Profile"),
                                'visible' => !Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to('@web/adverts/user', array('id' => Yii::$app->user->id)),
                                'label' => "<i class='fa fa-bullhorn'></i>" . t("My adverts"),
                                'visible' => !Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to('@web/adverts/favorites'),
                                'label' => "<i class='fa fa-bookmark-o'></i>" . t("Favorites advert"),
                                'visible' => !Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to("@web/messages"),
                                'label' => "<i class='fa fa-comment-o'></i>" . t("Messages"),
                                'visible' => !Yii::$app->user->isGuest
                            ),
                            array('url' => Url::to('@web/logout'),
                                'label' => "<i class='fa fa-sign-out'></i>" . t("Logout") . ' (' . Yii::$app->user->identity->username . ')',
                                'visible' => !Yii::$app->user->isGuest
                            ),
                        ),
                    ));
                    ?>


                </div>
            </div>
        </div>
        <div id='content'>
            <div id="body_area">
                <div class="left">
                    <div class="left_menu_area">
                        <div align="right">
                            <?php
                            $catTreeGenerator = new Category();
                            $catTreeGenerator->menuItems(0);


                            echo Menu::widget( array(
                                'items' => $catTreeGenerator->menuItems(intval($_GET['cat_id'])),
                                'options' => array('class' => 'nav sidebar-menu'),
                                //'encodeLabel' => FALSE,
                                //'submenuHtmlOptions' => array('class' => 'submenu'),
                                    )
                            );
                            ?>
                        </div>
                    </div>



                    <?= $this->context->getBanner('right_adv') ?>
                    <div class='articleList'>

                        <?

                        //------------articlae list ----
                        /*

                        if( isset( $this->context->indexAdv ) ) {
                            //echo "";
                            echo ListView::widget([
                                'dataProvider' => $this->context->indexAdv,
                            ]);
                        }
                        /**/

                        ?>
                    </div>


                </div>
                <div class="midarea">
                    <form name='search_form' class='searchForm' action='<?= Url::to('@web//adverts/search') ?>'>
                        <input type='text' name='searchStr'
                               value='<?= Yii::$app->request->get('searchStr') ?>' />
                        <input type='submit' value='Поиск' class='btn btn-light' /> <br/>
                        <a href="javascript:void(0)" onclick="open_search()" ><?= t("Advanced search") ?></a>


                        <div id='advanced_search' <? echo is_array(Yii::$app->request->get("Adverts")) ? "" : "style='display:none'" ?> >
                            <?
                            /*
                            $this->widget('application.widgets.advancedSearch');
                             *
                             */ ?>
                        </div>
                    </form>
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        echo Breadcrumbs::widget( array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif; ?>



                    <?php echo $content; ?>

                </div>
                <br style='clear:both' />
            </div>
        </div>

        <div id="fotter">
            <div class="fotter_copyrights">
                <div class="lang_box"> <a class="it" href="<?= Url::to("@web/site/language/lang/it") ?>" class="lang_selecter" >It</a>
                    <a class="ru" href="<?= Url::to("@web/site/language/lang/ru") ?>" class="lang_selecter" >Ru</a>
                    <a class="en" href="<?= Url::to("@web/site/language/lang/ru") ?>" class="lang_selecter" >En</a>
                </div>
                <div align="center"> © Copyright Information Goes Here. All Rights Reserved  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a href="http://validator.w3.org/check?uri=referer" target="_blank" class="xhtml">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="css">CSS</a>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

                    Developed By : <a href="http://vencendor.ru" class="fotter_designedlink">Vencendor</a> 


                </div>
            </div>

        </div>
        <?= yii\bootstrap4\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
