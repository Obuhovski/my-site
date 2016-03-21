<?php
use common\modules\blog\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>

<div class="categories widget">
    <h3 class="widget-head">Категории</h3>
    <ul>
        <?php
        foreach ($categories as $category) {
            /* @var $category Category */
        ?>
        <li>
            <a href="<?=Url::to(['post/index','category'=>$category->id])?>"><?=$category->name?></a> <span class="badge"><?=count($category->posts)?></span>
        </li>
        <?php } ?>
    </ul>
</div>
