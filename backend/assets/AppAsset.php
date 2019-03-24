<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/adminlte.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        'css/bootstrap3-wysihtml5.all.min.css',
        'css/site.css'
    ];
    public $js = [
        'js/jquery-ui.min.js',
        'js/bootstrap.bundle.min.js',
        'js/bootstrap3-wysihtml5.all.min.js',
        'js/bootstrap3-wysihtml5.all.min.js',
        'js/jquery.slimscroll.min.js',
        'js/fastclick.min.js',
        'js/adminlte.min.js',
        'js/dashboard.js',
        'js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
