<?php

namespace backend\widgets;

use yii\grid\DataColumn;
use yii\helpers\Html;

class AdminDataColumn extends DataColumn
{

    public function renderHeaderCell()
    {
        $direction = $this->grid->dataProvider->getSort()->getAttributeOrder($this->attribute);
        if (!is_null($direction)) {
            $this->headerOptions['class'] = $direction === SORT_DESC ? 'sorting_desc' : 'sorting_asc';
        }

        return Html::tag('th', $this->renderHeaderCellContent(), $this->headerOptions);
    }
}