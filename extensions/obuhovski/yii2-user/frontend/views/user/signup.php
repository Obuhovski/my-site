<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model obuhovski\user\models\User */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-signup row">
    <div class="col-sm-6 col-sm-offset-3">

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'action' => Url::to(['/user/user/signup']),
            'enableAjaxValidation'=>true,
        ]); ?>

        <?= $form->field($model,'username') ?>

        <?= $form->field($model,'email') ?>

        <?= $form->field($model,'password')->passwordInput() ?>

        <?= $form->field($model,'rePassword')->passwordInput() ?>

        <button type="submit" class="btn btn-success">Отправить</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>
