<?php

namespace backend\components;

use Yii;
use yii\base\Behavior;
use yii\web\Application;

class CheckIfLoggedIn extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'changeLanguage'
        ];
    }

    public function changeLanguage()
    {
        if (Yii::$app->request->cookies->has('lang')) {
            Yii::$app->language = Yii::$app->request->cookies->getValue('lang');
        }
    }
}