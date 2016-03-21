<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace obuhovski\blog\widgets;

use obuhovski\blog\models\Post;

/**
 *
 */
class PopularPostsWidget extends \yii\bootstrap\Widget
{

    public function init()
    {
        parent::init();

        $posts = Post::find()->where(['status'=>1])->orderBy(['views' => SORT_DESC])->all();

        echo  $this->render('posts',['posts'=>$posts]);
    }
}
