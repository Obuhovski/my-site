<?php

use obuhovski\blog\models\Post;
use obuhovski\blog\widgets\CategoriesWidget;
use obuhovski\blog\widgets\PopularPostsWidget;
use obuhovski\comments\widgets\LastCommentsWidget;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapPluginAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
            <div class="row">
                <div class="col-md-8">
                    <?php foreach ($models as $model) { ?>
                        <?php /** @var Post $model */ ?>
                        <article class="wow fadeInDown" data-wow-delay=".3s" data-wow-duration="300ms">
                            <div class="blog-post-image">
                                <a href="<?=Url::to(['post/view','slug'=>$model->slug])?>"><img class="img-responsive" width="100%" src="<?=$model->getUploadUrl('image')?>" alt="" /></a>
                            </div>
                            <div class="blog-content">
                                <h2 class="blogpost-title">
                                    <a href="<?=Url::to(['post/view','slug'=>$model->slug])?>"><?=$model->title?></a>
                                </h2>
                                <div class="blog-meta">
                                    <span><i class="glyphicon glyphicon-time"></i> <?=$model->created ?></span>
                                    <span><i class="glyphicon glyphicon-tag"></i>
                                        <?php
                                        $categoriesHtmlList = '';
                                        foreach ($model->categories as $category) {
                                            $categoriesHtmlList .= Html::a($category->name,['post/index','category'=>$category->id]).', ';
                                        }
                                        $categoriesHtmlList = substr($categoriesHtmlList,0,-2);
                                        echo $categoriesHtmlList;
                                        ?>
                                    </span>
                                </div>
                                <p><?=$model->anotation?></p>
                                <a href="<?=Url::to(['post/view','slug'=>$model->slug])?>" class="btn btn-dafault btn-details">Читать полностью</a>
                            </div>

                        </article>
                    <?php } ?>

                    <?=LinkPager::widget([
                        'pagination' => $pages
                    ]);?>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="search widget">
                            <?php $form = ActiveForm::begin([
                                'action'=>Url::to(['post/index']),
                                'method'=>'get',
                                'options'=>['class'=>'searchform'],
                                'validateOnChange' => false,
                            ]) ?>
                            <?php
                            $field = $form->field($postSearchForm,'search',['options'=>['class'=>'input-group']]);
                            $field->textInput(['name'=>'search','placeholder'=>'Поиск']);
                            $button = '<span class="input-group-btn">
                                           <button class="btn btn-default" type="submit"> <i class="ion-search"></i> </button>
                                       </span>';
                            $field->template = "<div class='input-group'>{input}$button\n</div>{error}";
                            echo $field;
                            ?>
                            <?php ActiveForm::end() ?>
                        </div>

                        <?= CategoriesWidget::widget() ?>

                        <?= PopularPostsWidget::widget() ?>

                        <?= LastCommentsWidget::widget() ?>

                    </div>
                </div>
            </div>
</div>
