<?php

namespace common\repositories;

use common\models\Page;
use Yii;

class PageRepository
{
    private $model;
    private $query;

    public function __construct()
    {
        $this->model = new Page();
        $this->query = Page::find();
    }

    public function getPages(bool $all = false, array $pageIds)
    {
        $query = $this->query
            ->select(['id', 'title'])
            ->where(['=', 'lang', Yii::$app->language])
            ->andWhere(['=', 'in_menu', 1]);

        if ($pageIds) {
            $query->andWhere(['not in', 'id', $pageIds]);
        }

        $pages      = $query->all();
        $ids        = array_column($pages, 'id');
        $titles     = array_column($pages, 'title');
        $pagesArray = array_combine($ids, $titles);

        if ($all) {
            array_unshift($pagesArray, 'Корневой элемент');
        }

        return $pagesArray;
    }
}