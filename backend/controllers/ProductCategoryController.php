<?php

namespace backend\controllers;

use common\models\Menu;
use common\models\ProductCategory;
use common\repositories\ProductCategoryRepository;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\base\Module;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class ProductCategoryController extends BaseController
{
    private $createRoute = '/product-category/create';
    protected $indexRoutePath = '/product-category/index';
    private $repository;

    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->repository = new ProductCategoryRepository();
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        $actions = [
            'nodeMove' => [
                'class'     => 'klisl\nestable\NodeMoveAction',
                'modelName' => $this->model::className(),
            ],
        ];

        return ArrayHelper::merge($actions, parent::behaviors());
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'nodeMove'],
                        'allow'   => true,
                    ]
                ],
            ],
            'verbs'  => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    public function getModel(): ActiveRecord
    {
        return new ProductCategory();
    }

    public function getSearch(): ActiveRecord
    {
        return new ProductCategory();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }

    public function actionIndex()
    {
        $query = $this->model::find()->where(['depth' => '0']);

        return $this->render('index', [
            'query' => $query,
        ]);
    }

    public function actionCreate()
    {
        if ($this->model->load(Yii::$app->request->post())) {
            if (is_null($this->model->parent_id)) {
                /** @var  $rootModel Menu|NestedSetsBehavior */
                $rootModel = new ProductCategory(['name' => 'Каталог', 'slug' => '/']);
                $rootModel->makeRoot(); //делаем корневой
                $this->model->appendTo($rootModel);
                $this->model->parent_id = $rootModel->id;
            } else {
                $rootModel = $this->repository->findById($this->model->parent_id);
                $this->model->appendTo($rootModel); //вставляем в конец корневого элемента
            }

            if ($this->model->save()){
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $this->model,
            'parentList' => $this->repository->getSelectList(Yii::$app->language)
        ]);
    }

    public function actionUpdate($id)
    {
        $this->model = $this->repository->findById($id);
        if ($this->model->load(Yii::$app->request->post())) {
            $rootModel = $this->repository->findById($this->model->parent_id);
            $this->model->appendTo($rootModel);
            if ($this->model->save()){
                return $this->redirect('index');
            }
        }

        return $this->render('create', [
            'model' => $this->model,
            'parentList' => $this->repository->getSelectList(Yii::$app->language, $this->model->id)
        ]);
    }

    public function actionView($id)
    {
        $model = $this->menuRepository->findById($id);
        $canCreate = false;
        if (is_null($model)) {
            throw new NotFoundHttpException(Yii::t('backend/errors', 'http_not_found'));
        }

        $pageIds = $this->menuRepository->getPageIds($model->id);
        $pages   = $this->pageRepository->getPages(false, $pageIds);
        if (count($pages)) {
            $canCreate = true;
        }

        return $this->render('view', [
            'rootTitle' =>  Yii::t('backend/modules/menu/root-items', $model->slug),
            'query' => $this->menuRepository->getRootQueryById($model->id),
            'canCreate' => $canCreate,
            'createUrl' => $this->createRoute . '?root=' . $model->id,
            'rootId' => $model->id
        ]);
    }
}
