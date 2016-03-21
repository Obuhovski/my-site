<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace obuhovski\comments\widgets;

use obuhovski\comments\CommentsAsset;
use obuhovski\comments\models\Comment;
use obuhovski\comments\models\forms\CommentForm;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/**
 *
 */
class CommentsWidget extends \yii\bootstrap\Widget
{
    public $captchaAction = 'site/captcha';
    public $entity;

    public function init()
    {
        parent::init();
        CommentsAsset::register($this->view);
    }

    public function run()
    {
        $commentForm = $this->createComment();
        if (isset(Yii::$app->session['email']) && isset(Yii::$app->session['email'])) {
            $commentForm->email = Yii::$app->session['email'];
            $commentForm->username = Yii::$app->session['username'];
        }

        $comments = Comment::find()->where(['entity' => $this->entity, 'status' => 1])->tree();
        echo $this->render('comments', compact('comments', 'commentForm'));
    }

    public function createComment()
    {
        $commentForm = new CommentForm(['captchaAction'=>$this->captchaAction]);
        $commentForm->entity = $this->entity;

        if ($commentForm->load(\Yii::$app->request->post()) && $commentForm->create()) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session['email'] = $commentForm->email;
                Yii::$app->session['username'] = $commentForm->username;
            }
            $commentForm->content = '';
            Yii::$app->response->refresh();
        }

        return $commentForm;
    }


}
