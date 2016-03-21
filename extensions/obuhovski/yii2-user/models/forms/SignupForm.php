<?php
/**
 * Created by PhpStorm.
 * User: programmer6
 * Date: 09.02.2016
 * Time: 16:58
 */

namespace obuhovski\user\models\forms;


use obuhovski\user\models\User;
use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;

    /** @var User $this->user */
    public $user;

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rePassword' => 'Повторите пароль',
        ];
    }

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['username', 'unique', 'targetClass' => User::className()],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => "Логин должен состоять только из латинских букв и цифр без пробелов"],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className()],

            ['password', 'required'],

            ['rePassword', 'required'],
            ['rePassword', 'compare', 'compareAttribute'=>'password'],

        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->setAttributes($this->attributes,false);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = User::STATUS_ACTIVE;

            if ($user->save(false)) {
                $role = Yii::$app->authManager->getRole('User');
                Yii::$app->authManager->assign($role,$user->id);
                return true;
            }
        }

        return false;
    }
}