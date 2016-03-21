<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

?>
<div class="site-error">

    <section class="moduler wrapper_404">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".4s" ><?=$exception->statusCode?></h1>
                        <h2 class="wow fadeInUp animated" data-wow-delay=".6s"><?= nl2br(Html::encode($message)) ?></h2>
                        <a href="index.html" class="btn btn-dafault btn-home wow fadeInUp animated" data-wow-delay="1.1s">На главную</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
