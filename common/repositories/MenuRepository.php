<?php

namespace common\repositories;

use common\models\Menu;

class MenuRepository
{
    const TOP_MENU    = 'top';
    const BOTTOM_MENU = 'bottom';
    const MOBILE_MENU = 'mobile';

    private $model;
    private $query;

    public static $menus = [
        self::TOP_MENU,
        self::BOTTOM_MENU,
        self::MOBILE_MENU,
    ];

    public function __construct()
    {
        $this->model = new Menu();
        $this->query = Menu::find();
    }

    public function findById(int $id): Menu
    {
        return $this->model::findOne($id);
    }

    public function getPageIds(int $rootId)
    {
        $this->model = $this->findById($rootId);
        $children    = $this->model->children()->all();
        if (empty($children)) {
            return $children;
        }

        $ids = array_column($children, 'page_id');

        return $ids;
    }

    public function getRootQueryById($id)
    {
        return $this->query->where(['id' => $id]);
    }

    public function hasChildren(Menu $model) : bool
    {
        return (int)$model->children()->count();
    }
}