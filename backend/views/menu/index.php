<?php

use backend\widgets\AdminGridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/* @var $query \yii\db\ActiveQuery */

$this->title                   = Yii::t('backend/modules/menu/main', 'title');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-index">
    <?= AdminGridView::widget([
        'dataProvider' => $dataProvider,
        'pager'        => [
            'class' => 'backend\widgets\AdminPager'
        ],
        'columns'      => [
            'name',
            'slug',
            [
                'class'    => ActionColumn::class,
                'header'   => 'Действия',
                'headerOptions' => ['style' => 'width:10%'],
                'template' => '{view}',
                'buttons'  => [
                    'view' => function ($url) {
                        return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, [
                            'title' => Yii::t('backend/app', 'view'),
                        ]);
                    }
                ],
            ]
        ],
    ]) ?>
</div>