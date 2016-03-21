<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model obuhovski\user\models\User */

$this->title = 'Логин';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login row">
    <div class="col-sm-6 col-sm-offset-3">

        <?php $form = ActiveForm::begin([
            'id' => 'form-login',
            'action' => Url::to(['/user/user/login']),
            'enableAjaxValidation'=>true,
        ]); ?>

        <?= $form->field($model,'username') ?>

        <?= $form->field($model,'password')->passwordInput() ?>

        <button type="submit" class="btn btn-success">Отправить</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>
