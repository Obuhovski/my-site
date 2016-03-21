<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace obuhovski\user\widgets;

use obuhovski\comments\CommentsAsset;
use obuhovski\comments\models\Comment;
use obuhovski\comments\models\forms\CommentForm;
use Yii;
use yii\helpers\VarDumper;

/**
 *
 */
class AuthWidget extends \yii\bootstrap\Widget
{

    public function run()
    {
       return $this->render('auth');
    }


}
