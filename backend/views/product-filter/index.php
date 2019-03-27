<?php

use backend\widgets\AdminGridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductFilterGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $createRoute string - Адрес для создания новой записи */

$this->title = Yii::t('backend/modules/product-filter-group/main', 'title');

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'class' => 'breadcrumb-item'
];
?>

<div class="row">
    <?php Pjax::begin(); ?>
    <div class="col-12">
        <?=
        Html::a(
            '<i class="fa fa-plus"></i>' . Yii::t('backend/modules/product-filter-group/main', 'create_button'),
            [$createRoute],
            ['class' => 'btn btn-app']
        )
        ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= AdminGridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'pager'        => [
                        'class' => 'backend\widgets\AdminPager'
                    ],
                    'columns'      => [
                        'id',
                        'title',
                        'priority',
                        [
                            'attribute'      => 'group_id',
                            'format'         => 'raw',
                            'value'          => function ($model) {
                                return $model->group->title;
                            },
                            'contentOptions' => ['class' => 'text-center'],
                            'filter'         => Html::activeDropDownList($searchModel, 'group_id', $this->params['groupSelect'], ['class' => 'form-control', 'prompt' => '']),
                        ],
                        [
                            'class'    => \yii\grid\ActionColumn::class,
                            'header'   => 'Действия',
                            'template' => '{update} {delete}',
                            'buttons'  => [
                                'update' => function ($url) {
                                    return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('backend/app', 'Редактировать'),
                                    ]);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('backend/app', 'Удалить'),
                                    ]);
                                }

                            ],
                        ]
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
