<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace obuhovski\comments;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CommentsAsset extends AssetBundle
{
    public $sourcePath = '@obuhovski/comments/assets';
    public $js = [
        'main.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
