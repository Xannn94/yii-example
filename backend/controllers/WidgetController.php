<?php

namespace backend\controllers;

use common\models\Widget;
use common\models\WidgetSearch;
use yii\base\Module;
use yii\db\ActiveRecord;

/**
 * WidgetController implements the CRUD actions for News model.
 */
class WidgetController extends BaseController
{
    private $createRoute = '/widget/create';

    public function __construct(string $id, Module $module, array $config = [])
    {
        $this->view->params['typeList'] = [
            'text' => 'Текст',
            'redactor' => 'Редактор'
        ];
        parent::__construct($id, $module, $config);
    }

    public function getModel(): ActiveRecord
    {
        return new Widget();
    }

    public function getSearch(): ActiveRecord
    {
        return new WidgetSearch();
    }

    public function getCreateRoute(): string
    {
        return $this->createRoute;
    }
}
