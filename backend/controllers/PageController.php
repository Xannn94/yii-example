<?php

namespace backend\controllers;

use common\models\Page;
use common\models\PageSearch;
use yii\db\ActiveRecord;

/**
 * PageController implements the CRUD actions for News model.
 */
class PageController extends BaseController
{
    private $createRoute = '/page/create';

    public function getModel(): ActiveRecord
    {
        return new Page();
    }

    public function getSearch(): ActiveRecord
    {
        return new PageSearch();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }
}
