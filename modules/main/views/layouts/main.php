<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

?>

<?php Yii::$app->view->beginContent(__DIR__.'/base.php') ?>

<section>
    <div class="container">
        <?= $content ?>
    </div>
</section>


<?php Yii::$app->view->endContent() ?>

