<?php

namespace backend\controllers;

use common\models\News;
use common\models\NewsSearch;
use common\traits\FileControllerTrait;
use vova07\imperavi\actions\UploadAction;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BaseController
{
    use FileControllerTrait;

    private $createRoute = '/news/create';

    public function actions()
    {
        $actions = [
            'image-upload' => [
                'class'            => UploadAction::class,
                'url'              => 'http://admin.yii-test.loc/uploads/images',
                'path'             => '@webroot' . '/uploads/images',
                'validatorOptions' => [
                    'maxSize' => 100000
                ]
            ],
            'file-upload'  => [
                'class'            => UploadAction::class,
                'url'              => 'http://admin.yii-test.loc/uploads/files',
                'path'             => '@webroot' . '/uploads/files',
                'uploadOnlyImage' => false,
                'validatorOptions' => [
                    'maxSize' => 100000
                ]
            ],
        ];

        return ArrayHelper::merge($actions,parent::behaviors());
    }

    public function behaviors()
    {
        $behaviors = [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['image-upload', 'file-upload'],
                        'allow'   => true,
                    ]
                ],
            ],
        ];

        return ArrayHelper::merge($behaviors,parent::behaviors());
    }

    public function getModel(): ActiveRecord
    {
        return new News();
    }

    public function getSearch(): ActiveRecord
    {
        return new NewsSearch();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }
}
