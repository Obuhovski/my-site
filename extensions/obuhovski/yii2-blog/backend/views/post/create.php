<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model obuhovski\blog\models\Post */

$this->title = 'Новый пост';
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
