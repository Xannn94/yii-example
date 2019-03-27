<?php

namespace backend\controllers;

use common\models\ProductFilterGroup;
use common\models\ProductFilterGroupSearch;
use yii\db\ActiveRecord;

class ProductFilterGroupController extends BaseController
{
    private $createRoute = '/product-filter-group/create';
    protected $indexRoutePath = '/product-filter-group/index';

    public function getModel(): ActiveRecord
    {
        return new ProductFilterGroup();
    }

    public function getSearch(): ActiveRecord
    {
        return new ProductFilterGroupSearch();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }
}
