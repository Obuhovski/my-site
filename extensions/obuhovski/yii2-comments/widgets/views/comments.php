<?php
use obuhovski\blog\models\Post;
use obuhovski\comments\models\Comment;
use obuhovski\comments\models\forms\CommentForm;
use obuhovski\user\widgets\AuthWidget;
use yii\bootstrap\ActiveField;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $comments Comment */
/* @var $commentForm CommentForm */

?>

<div class="comments widget">
    <div class="row">
        <?php Pjax::begin(['id'=>'comments-pjax']) ?>
            <div class="col-md-12">

                <?php if (!empty($comments)) { ?>
                <h4>Комментарии</h4>
                <?php } ?>

                <div class="comments">
                    <?= $this->render('_item',['comments'=>$comments]) ?>
                </div>

                <h3><a href="#comment-form" >Оставите комментарий</a></h3>
                <div class="post-comment">

                    <?=AuthWidget::widget()?>

                    <?php $form = ActiveForm::begin([
                        'options'=>[
                            'class'=>'form-horizontal',
                            'data-pjax' => true,
                        ],
                        'fieldConfig' => [
                            'template' => "{input}\n{hint}\n{error}",
                        ],
                        'validateOnChange' => false,
                        'validateOnBlur' => false,
                    ]) ?>
                        <?= Html::activeHiddenInput($commentForm,'parent_id')?>
                        <?php if (Yii::$app->user->isGuest) { ?>
                            <div class="form-group">
                                <?= $form->field($commentForm,'username',['options'=>['class'=>'col-lg-6']])
                                    ->textInput(['class'=>'col-lg-12 form-control','placeholder'=>'Имя'])?>
                                <?= $form->field($commentForm,'email',['options'=>['class'=>'col-lg-6']])
                                    ->textInput(['class'=>'col-lg-12 form-control','placeholder'=>'Email'])?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <?= $form->field($commentForm,'content',['options'=>['class'=>'col-lg-12']])
                                ->textarea(['rows'=>8, 'class'=>'form-control','placeholder'=>'Сообщение'])?>
                        </div>
                        <p></p>
                        <p>
                            <button class="btn btn-send" type="submit">Отправить</button>
                        </p>
                        <p></p>
                    <?php ActiveForm::end() ?>
                </div>
        </div>
    <?php Pjax::end() ?>
</div>
