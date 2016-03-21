<?php
use app\helpers\DateTime;
use obuhovski\blog\models\Post;
use obuhovski\comments\models\Comment;
use obuhovski\comments\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $comment array */

foreach ($comments as $comment) {
    $comment['created_at'] = DateTime::fromSql($comment['created_at'],'d M Y в H:i')
?>
    <div id="<?=$comment['id']?>" class="media" style="margin-left: <?= $comment['level'] * 50 ?>px">
        <a href="" class="pull-left">
                <img alt="" src="<?=$comment['avatar']?>" class="media-object">
        </a>

        <div class="media-body">
            <h4 class="media-heading">
                <?= Html::encode($comment['username']) ?></h4>

            <p class="text-muted">
                <?= $comment['created_at']?>
            </p>

            <p><?= Html::encode($comment['content']) ?></p>
            <a href="#comment-form" data-comment-id="<?= $comment['id'] ?>">Ответить</a>
            <hr>
        </div>
    </div>

<?php
    if (isset($comment['childrens'])) {
        echo $this->render('_item',['comments'=>$comment['childrens']]);
    }
}
?>

