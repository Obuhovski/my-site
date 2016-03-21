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
use yii\base\Widget;
use yii\helpers\VarDumper;

/**
 *
 */
class LastCommentsWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $comments = Comment::find()->where(['status' => 1])->orderBy('created_at DESC')->limit(10)->all();
        echo $this->render('last-comments', compact('comments'));
    }



}
