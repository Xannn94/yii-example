<?php

namespace backend\controllers;

use common\models\ProductFilter;
use common\models\ProductFilterSearch;
use common\repositories\FilterGroupRepository;
use Yii;
use yii\base\Module;
use yii\db\ActiveRecord;

class ProductFilterController extends BaseController
{
    private $createRoute = '/product-filter/create';
    protected $indexRoutePath = '/product-filter/index';
    protected $groupRepository;

    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->groupRepository = new FilterGroupRepository();
        $this->view->params['groupSelect'] = $this->groupRepository->select(Yii::$app->language);
        parent::__construct($id, $module, $config);
    }

    public function getModel(): ActiveRecord
    {
        return new ProductFilter();
    }

    public function getSearch(): ActiveRecord
    {
        return new ProductFilterSearch();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }
}
