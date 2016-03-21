<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace obuhovski\blog\widgets;

use obuhovski\blog\models\Category;

/**
 *
 */
class CategoriesWidget extends \yii\bootstrap\Widget
{

    public function init()
    {
        parent::init();

        $categories = Category::find()->where(['status'=>1])->with('posts')->all();

        echo  $this->render('categories',['categories'=>$categories]);
    }
}
