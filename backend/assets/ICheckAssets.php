<?php

namespace backend\assets;

use yii\web\AssetBundle;

class ICheckAssets extends AssetBundle
{
    public $css = [
        'iCheck/all.css'
    ];
    public $js  = [
        'iCheck/icheck.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
