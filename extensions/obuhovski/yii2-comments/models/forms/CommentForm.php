<?php
/**
 * Created by PhpStorm.
 * User: programmer6
 * Date: 12.02.2016
 * Time: 13:47
 */

namespace obuhovski\comments\models\forms;


use obuhovski\comments\models\Comment;
use obuhovski\comments\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class CommentForm extends Model
{
    public $username;
    public $email;
    public $content;
    public $parent_id;
    public $entity;
    public $captcha;
    public $created_by;

    public $captchaAction;


    public function attributeLabels()
    {
        return [
          'username' => 'Имя',
          'content' => 'Сообщение',
        ];
    }

    public function rules()
    {
        return [
            ['username','required', 'when' => function () {return Yii::$app->user->isGuest;}],
            ['username','string','length'=>[3,128]],

            ['email','required', 'when' => function () {return Yii::$app->user->isGuest;}],
            ['email','email'],

            ['content','trim'],
            ['content','required'],
            ['content','string'],

            ['parent_id','integer'],

            ['created_by','required', 'when' => function () {return !Yii::$app->user->isGuest;}],
        ];
    }

    public function create()
    {
        if (!Yii::$app->user->isGuest) {
            $this->created_by = Yii::$app->user->id;
        }

        if ($this->validate()) {

            return Yii::$app->db->transaction(function(){

                $comment = new Comment();
                $comment->setAttributes($this->attributes,false);

                if (empty($this->parent_id)) {
                    $comment->level = 0;
                } else {
                    $comment->level = Comment::findOne(['id'=>$this->parent_id])->level;
                    $comment->level++;
                }
                $comment->status = 1;
                $comment->created_at = (new \DateTime())->format('Y-m-d H:i:s');
                $comment->save(false);

                return true;

            });
        }

        return false;
    }


}