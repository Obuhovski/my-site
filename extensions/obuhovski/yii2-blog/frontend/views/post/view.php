<?php

use imanilchaudhari\socialshare\ShareButton;
use obuhovski\comments\widgets\CommentsWidget;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model obuhovski\blog\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = StringHelper::truncateWords($this->title,4);

$this->registerMetaTag(['property' => 'og:url', 'content' => Url::current()]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $model->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => StringHelper::truncateWords($model->anotation,10)]);
empty($model->image) or $this->registerMetaTag(['property' => 'og:image', 'content' => $model->getUploadUrl('image')]);

$model->updateCounters(['views'=>1]);
?>
<div class="post-view">
    <section class="single-post">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($model->image)) {?>
                        <div class="post-img">
                            <img class="img-responsive" alt="" width="100%" src="<?=$model->getUploadUrl('image')?>">
                        </div>
                    <?php } ?>
                    <div class="post-content">
                        <?=$model->text?>
                    </div>
                    <h4>Поделитесь этим постом</h4>
                    <script type="text/javascript">(function() {
                            if (window.pluso)if (typeof window.pluso.start == "function") return;
                            if (window.ifpluso==undefined) { window.ifpluso = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                var h=d[g]('body')[0];
                                h.appendChild(s);
                            }})();</script>
                    <div class="pluso" data-background="transparent" data-options="big,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,moimir,email,google,print"></div>

                </div>
            </div>


            <?=CommentsWidget::widget([
                'captchaAction' => '/blog/site/captcha',
                'entity' => $model->id
            ])?>
        </div>
    </section>

</div>
