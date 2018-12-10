<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900',
        'custom/css/bootstrap.min.css',
        'custom/css/font-awesome.min.css',
        'custom/css/owl.carousel.css',
        'custom/css/owl.theme.css',
        'custom/css/owl.transitions.css',
        'custom/css/meanmenu/meanmenu.min.css',
        'custom/css/animate.css',
        'custom/css/normalize.css',
        'custom/css/scrollbar/jquery.mCustomScrollbar.min.css',
        'custom/css/jvectormap/jquery-jvectormap-2.0.3.css',
        'custom/css/notika-custom-icon.css',
        'custom/css/wave/waves.min.css',
        'custom/css/main.css',
        'custom/css/style.css',
        'custom/css/responsive.css',
        'custom/js/vendor/modernizr-2.8.3.min.js',
    ];
    public $js = [
        'custom/js/vendor/jquery-1.12.4.min.js',
        'custom/js/bootstrap.min.js',
        'custom/js/wow.min.js',
        'custom/js/jquery-price-slider.js',
        'custom/js/owl.carousel.min.js',
        'custom/js/jquery.scrollUp.min.js',
        'custom/js/meanmenu/jquery.meanmenu.js',
        'custom/js/counterup/jquery.counterup.min.js',
        'custom/js/counterup/waypoints.min.js',
        'custom/js/counterup/counterup-active.js',
        'custom/js/scrollbar/jquery.mCustomScrollbar.concat.min.js',
        'custom/js/jvectormap/jquery-jvectormap-2.0.2.min.js',
        'custom/js/jvectormap/jquery-jvectormap-world-mill-en.js',
        'custom/js/jvectormap/jvectormap-active.js',
        'custom/js/sparkline/jquery.sparkline.min.js',
        'custom/js/sparkline/sparkline-active.js',
        'custom/js/flot/jquery.flot.js',
        'custom/js/flot/jquery.flot.resize.js',
        'custom/js/flot/curvedLines.js',
        'custom/js/flot/flot-active.js',
        'custom/js/knob/jquery.knob.js',
        'custom/js/knob/jquery.appear.js',
        'custom/js/knob/knob-active.js',
        'custom/js/wave/waves.min.js',
        'custom/js/wave/wave-active.js',
        'custom/js/todo/jquery.todo.js',
        'custom/js/plugins.js',
        'custom/js/chat/moment.min.js',
        'custom/js/chat/jquery.chat.js',
        'custom/js/main.js',
        'custom/js/tawk-chat.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
