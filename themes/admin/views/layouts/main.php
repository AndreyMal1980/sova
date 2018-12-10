<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="/css/admin/style.css" />
        <title> <?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile('/js/admin/selectLang.js'); ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.js"></script>
    </head>
    <body>
        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Главная', 'url' => '/index.php/admin/'),
                        array('label' => 'На сайт', 'url' => '/'),
                       // array('label' => 'Loger', 'url' => '/admin/loger'),
                        //array('label' => 'Новости CMS', 'url' => '/admin/CMSNews'),
                        //array('label' => 'Помощь', 'url' => '/admin/CMSHelp'),
                        //array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        //array('label' => 'Contact', 'url' => array('/site/contact')),
                        //array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => array('/userLogout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        ));
        ?>

        <div class="container" id="page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink' => CHtml::link('admin'),
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <div class="row-fluid">
                <div class="span3">   
                   
                    <div style="padding: 8px 0;" class="well">
                        <?php/* $this->widget('AdminLeftNewsWidget'); */?>
                    </div> 
                    
                    <div style="padding: 8px 0;" class="well">
                        <?php $this->widget('AdminLeftMenuWidget'); ?>
                    </div>          
                    <div class="well sidebar-nav">

                        <h3>Сегодня: <?php echo date('d.m.Y'); ?></h3>
                            
                    </div>
                    <!--Sidebar content-->
                </div>
                <div class="span9">
<?php echo $content; ?>

                    <!--Body content-->
                </div>
            </div>

<?php //echo $content;   ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by UpLine24.<br/>
                All Rights Reserved.<br/>
<?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
