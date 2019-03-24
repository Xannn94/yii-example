<?php

namespace backend\assets;

use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle
{
    public $css = [
        'css/dataTables.bootstrap4.css'
    ];
    public $js  = [
        'js/jquery.dataTables.min.js',
        'js/dataTables.bootstrap4.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\grid\GridViewAsset'
    ];
}
