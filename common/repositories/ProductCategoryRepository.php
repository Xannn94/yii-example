<?php

namespace common\repositories;

use common\models\ProductCategory;
use Yii;

class ProductCategoryRepository
{
    private $model;
    private $query;

    public function __construct()
    {
        $this->model = new ProductCategory();
        $this->query = ProductCategory::find();
    }

    public function findById(int $id): ProductCategory
    {
        return $this->model::findOne($id);
    }

    public function hasChildren(ProductCategory $model): bool
    {
        return (int)$model->children()->count();
    }

    public function getSelectList(string $lang, int $currentId = 0): array
    {
        $root     = $this->getRoot($lang);
        $select   = [$root->id => $root->name];
        if (is_null($root)) {
            return [];
        }

        $select   = $this->getChildrenSelect($root, $select);
        if ($currentId) {
            unset($select[$currentId]);
        }

        return $select;
    }

    public function getChildrenSelect(ProductCategory $node, array $items = []): array
    {
        $children = $node->children()->all();
        foreach ($children as $child) {
            $items[$child->id] = str_repeat('-', $child->depth) . ' ' . $child->name;
            if ($this->hasChildren($child)) {
                $this->getChildrenSelect($child, $items);
            }
        }

        return $items;

        return $items;
    }

    public function getRoot(string $lang)
    {
        return $this->model->find()->where(['depth' => 0])->andWhere(['lang' => $lang])->one();
    }
}