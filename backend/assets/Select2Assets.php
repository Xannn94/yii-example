<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Select2Assets extends AssetBundle
{
    public $css = [
        'css/select2.min.css'
    ];
    public $js  = [
        'js/select2.full.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
