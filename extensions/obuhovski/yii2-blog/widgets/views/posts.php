<?php
use obuhovski\blog\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>

<div class="popular-post widget">
    <h3>Популярные записи</h3>

    <ul>
        <?php
        foreach ($posts as $post) {
        /* @var $post Post */
        ?>
        <li>
            <a href=<?=Url::to(['post/view','slug'=>$post->slug])?>><?=$post->title?></a><br>
            <time><i class="glyphicon glyphicon-time"></i> <?=$post->created?></time> <time><i class="glyphicon glyphicon-eye-open"></i> <?=$post->views?></time>
        </li>
        <?php } ?>
    </ul>

</div>
