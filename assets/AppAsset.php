<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/ionicons.min.css',
        'css/animate.css',
        'css/slider.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/jquery.fancybox.css',
        'css/main.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/vendor/modernizr-2.6.2.min.js',
        'js/owl.carousel.min.js',
        'js/wow.min.js',
        'js/slider.js',
        'js/jquery.fancybox.js',
        'js/main.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
