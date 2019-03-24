<?php

namespace backend\controllers;

use common\models\Menu;
use common\repositories\MenuRepository;
use common\repositories\PageRepository;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for News model.
 */
class MenuController extends BaseController
{
    private $createRoute = '/menu/create';
    private $viewRoute   = '/menu/view';
    private $pageRepository;
    private $menuRepository;

    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->pageRepository = new PageRepository();
        $this->menuRepository = new MenuRepository();
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

    public function getModel(): ActiveRecord
    {
        return new Menu();
    }

    public function getSearch(): ActiveRecord
    {
        return new Menu();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }

    public function actionIndex()
    {
        $query        = $this->model::find()->where(['depth' => '0']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'query'        => $query,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate($root = null)
    {
        /** @var  $model Menu|NestedSetsBehavior */
        $model     = new Menu ();
        $rootModel = $this->menuRepository->findById($root);
        if ($model->load(Yii::$app->request->post())) {
            $model->appendTo($rootModel);
            if ($model->save()) {
                return $this->redirect($this->viewRoute . '?id=' . $root);
            }
        }

        $pageIds = $this->menuRepository->getPageIds($root);
        $pages   = $this->pageRepository->getPages(false, $pageIds);

        return $this->render('create', [
            'model' => $this->model,
            'pages' => $pages
        ]);
    }

    public function actionUpdate($id, $root = null)
    {
        $model = $this->menuRepository->findById($id);
        if (is_null($model)) {
            throw new NotFoundHttpException(Yii::t('backend/errors', 'http_not_found'));
        }

        $rootModel = $this->menuRepository->findById($root);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect('index');
            }
        }

        $pageIds = $this->menuRepository->getPageIds($rootModel->id);
        $indexCurrentPage = array_search($model->page_id, $pageIds);
        if (isset($pageIds[$indexCurrentPage])) {
            unset($pageIds[$indexCurrentPage]);
        }

        $pages   = $this->pageRepository->getPages(false, $pageIds);

        return $this->render('update', [
            'model' => $model,
            'pages' => $pages,
            'rootTitle' =>  Yii::t('backend/modules/menu/root-items', $rootModel->slug),
            'rootId' =>  $rootModel->id,
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
