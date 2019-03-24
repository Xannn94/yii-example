<?php

namespace backend\controllers;

use Yii;
use yii\base\Module;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

abstract class BaseController extends Controller
{
    protected $perPage     = 10;
    protected $defaultOrder = [
        'id' => SORT_DESC
    ];
    protected $indexRoutePath;
    protected $showRoutePath;

    public $layout = 'app';
    public $model;

    abstract public function getCreateRoute(): string;

    abstract public function getModel(): ActiveRecord;

    abstract public function getSearch(): ActiveRecord;

    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->model = $this->getModel();
        $this->indexRoutePath = '/' . $id . '/index';
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update','delete'],
                        'allow'   => true,
                    ]
                ],
            ],
            'verbs'  => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function getQuery(): ActiveQuery
    {
        return $this->model::find();
    }

    /**
     * Если необходимо загружать файлы нужно заполнить конфиг params.php
     * и подключить трейт common/traits/FileControllerTrait.
     * Также нужно подключить трейт common/traits/FileModelTrait в вашу модель
     *
     * @param ActiveRecord $model
    */
    public function uploadFiles(ActiveRecord $model)
    {
        if (method_exists($this,'upload')) {
            $this->upload($model);
        }
    }

    public function afterSave(ActiveRecord $model)
    {
        $this->uploadFiles($model);
    }

    public function afterUpdate(ActiveRecord $model)
    {
        $this->uploadFiles($model);
    }

    /**
     * Displays data table.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = $this->getSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $this->perPage;
        $dataProvider->sort->defaultOrder = $this->defaultOrder;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'createRoute'  => $this->getCreateRoute()
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            $this->model->save();
            $this->afterSave($this->model);

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $this->model,
        ]);
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $this->model = $this->findById($id);

        if (is_null($this->model)) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            $this->model->save();
            $this->afterUpdate($this->model);

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $this->model,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete(int $id)
    {
        $this->model = $this->findById($id);

        if (!is_null($this->model)) {
            $this->model->delete();
        }

        return $this->redirect($this->indexRoutePath);
    }

    private function findById(int $id)
    {
        return $this->model = $this->model::findOne($id);
    }
}
