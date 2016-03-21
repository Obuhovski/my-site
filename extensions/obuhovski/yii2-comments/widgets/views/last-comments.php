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
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $comment Comment */

?>

<div class="popular-post widget">
    <h3>Популярные комментарии</h3>

    <ul>
        <?php
        foreach ($comments as $comment) {
        ?>
            <li>
                <a href="<?=$comment->entity.'#'.$comment->id?>">
                    <?=StringHelper::truncateWords($comment->content,20)?>
                </a>
                <br>
                <time>
                    <i class="glyphicon glyphicon-time"></i> <?=$comment->created_at?>
                </time>
            </li>
        <?php } ?>
    </ul>

</div>
