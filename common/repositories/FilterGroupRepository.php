<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.03.2019
 * Time: 21:26
 */

namespace common\repositories;


use common\models\ProductFilterGroup;
use yii\helpers\ArrayHelper;

class FilterGroupRepository
{
    public function getQuery()
    {
        return ProductFilterGroup::find();
    }

    public function select(string $lang)
    {
        $groups = $this->getQuery()
            ->select(['id', 'title'])
            ->where(['lang' => $lang])
            ->asArray()
            ->all();

        return ArrayHelper::map($groups, 'id', 'title');
    }
}