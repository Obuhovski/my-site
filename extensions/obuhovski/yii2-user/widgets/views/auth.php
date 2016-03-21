<?php


/* @var $this yii\web\View */
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\Modal;

?>

<?php
if (Yii::$app->user->isGuest) {
    Yii::$app->user->setReturnUrl(Yii::$app->request->getUrl());
?>
    <h4>
        <?=Modal::widget([
            'header' => 'Логин',
            'toggleButton' => [
                'class'=>'btn-link',
                'label'=>'Войти',
                'onclick' => '$(this).next().find(".modal-body").load("/user/user/login");'
            ]
        ])?>
        |
        <?=Modal::widget([
            'header' => 'Регистрация',
            'toggleButton' => [
                'class'=>'btn-link',
                'label'=>'Зарегистрироваться',
                'onclick' => '$(this).next().find(".modal-body").load("/user/user/signup");'
            ]
        ])?>
    </h4>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['/user/auth/auth']]) ?>
<?php } ?>