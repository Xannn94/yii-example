<?php

namespace backend\widgets;

use backend\assets\DataTableAsset;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

class AdminGridView extends GridView
{
    public $options = [
        'class' => 'dataTables_wrapper container-fluid dt-bootstrap4 grid-view'
    ];

    public $tableOptions = [
        'id'               => 'data-table',
        'class'            => 'table table-bordered table-striped dataTable',
    ];

    public $headerRowOptions = [
        'role' => 'row'
    ];

    public $dataColumnClass = 'backend\widgets\AdminDataColumn';

    public $layout = "{items}\n<div class='row'><div class='col-sm-12 col-md-5'>{summary}</div><div class='col-sm-12 col-md-7'><div class='dataTables_paginate paging_simple_numbers'>{pager}</div></div></div>";

    public function run()
    {
        $view = $this->getView();
        DataTableAsset::register($view);
        $id = $this->options['id'];
        $gridOptions = Json::htmlEncode(array_merge($this->getClientOptions(), ['filterOnFocusOut' => $this->filterOnFocusOut]));
        $view->registerJs("jQuery('#$id').yiiGridView($gridOptions);");
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback('/{\\w+}/', function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::tag($tag, $content, $options);
    }
}