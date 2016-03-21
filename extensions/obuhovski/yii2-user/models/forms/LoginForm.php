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

class LoginForm extends Model
{
    public $username;
    public $password;

    /** @var User $this->user */
    public $user;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => "Логин должен состоять только из латинских букв и цифр без пробелов"],

            ['password', 'required'],
            ['password', function(){
                $this->user = User::findByUsername($this->username);
                if (is_null($this->user) or !$this->user->validatePassword($this->password)) {
                    $this->addError('password','Неверный логин или пароль');
                }
            }],

        ];
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->getUser()->login($this->user);
        }

        return false;
    }
}