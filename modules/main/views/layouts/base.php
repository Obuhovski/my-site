<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kartik\alert\Alert;
use kartik\alert\AlertBlock;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Basic Page Needs
================================================== -->
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="Cache-Control" content="no-cache" />
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--
==================================================
Header Section Start
================================================== -->
<header id="top-bar" class="navbar-inverse navbar-fixed-top animated-header">
    <div class="container">
        <div class="navbar-header">
            <!-- responsive nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- /responsive nav button -->

            <!-- logo -->
            <div class="navbar-brand">
                <a href="<?= Yii::$app->homeUrl ?>" >
                    <img src="/images/logo.png" alt="">
                </a>
            </div>
            <!-- /logo -->
        </div>
        <!-- main menu -->
        <nav class="collapse navbar-collapse navbar-right" role="navigation">
            <div class="main-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= Yii::$app->homeUrl ?>">Главная</a></li>
                    <li><a href="<?= Url::to(['/blog']) ?>">Блог</a></li>
                    <li><a href="<?= Url::to(['/main/site/about']) ?>">О сайте</a></li>

                    <?php if (! Yii::$app->user->isGuest) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" style="text-transform: none" data-toggle="dropdown"><?=Yii::$app->user->identity->username?></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="<?= Url::to(['/user']) ?>">Профиль</a></li>
                                    <li><a href="<?= Url::to(['/user/user/logout']) ?>">Выход</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php }  ?>
                </ul>
            </div>
        </nav>
        <!-- /main nav -->
    </div>
</header>

<!--
==================================================
Global Page Section Start
================================================== -->

<?php if (isset($this->params['breadcrumbs'])) { ?>
<section class="global-page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <h2><?= $this->title ?></h2>
                    <?= Breadcrumbs::widget([
                        'tag' => 'ol',
                        'links' => $this->params['breadcrumbs'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#Page header-->
<?php } ?>

<?=AlertBlock::widget([
    'type' => AlertBlock::TYPE_GROWL,
])?>

<?= $content ?>

<!--
==================================================
Footer Section Start
================================================== -->
<footer id="footer">
    <div class="container">
        <div class="col-md-8">
            <p class="copyright">Copyright: <span>2015</span> by <a href="http://www.themefisher.com">themefisher</a></p>
        </div>
        <div class="col-md-4">
            <!-- Social Media -->
            <ul class="social">
                <li>
                    <a href="#" class="Facebook">
                        <i class="ion-social-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="Twitter">
                        <i class="ion-social-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="Linkedin">
                        <i class="ion-social-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="Google Plus">
                        <i class="ion-social-googleplus"></i>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</footer> <!-- /#footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
