<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;

class LanguageController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow'   => true,
                    ]
                ],
            ],
            'verbs'  => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    public function actionIndex()
    {
        $lang = Yii::$app->request->post('lang');

        if (!is_null($lang)) {
            Yii::$app->language = $lang;

            $coockie = new Cookie([
                'name'  => 'lang',
                'value' => $lang
            ]);

            Yii::$app->response->cookies->add($coockie);
        }

        return 1;
    }
}
