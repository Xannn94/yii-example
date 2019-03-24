<?php

use yii\helpers\VarDumper;

if (!function_exists('dump')) {
    function dump($var)
    {
        VarDumper::dump($var,100,true);
    }
}
if (!function_exists('dd')) {
    function dd($var)
    {
        dump($var);
        exit;
    }
}