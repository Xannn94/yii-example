<?php

use backend\widgets\AdminGridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $createRoute string - Адрес для создания новой записи */

$this->title = Yii::t('backend/modules/news/main', 'title');

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
            '<i class="fa fa-plus"></i>' . Yii::t('backend/modules/news/main', 'create_button'),
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
                        [
                            'attribute'      => 'active',
                            'label'          => Yii::t('backend/app/label', 'active'),
                            'format'         => 'raw',
                            'value'          => function ($model) {
                                return $model->active ?
                                    Yii::t('backend/app', 'yes') : Yii::t('backend/app', 'no');
                            },
                            'contentOptions' => ['class' => 'text-center'],
                            'filter'         => Html::activeDropDownList($searchModel, 'active', [
                                Yii::t('backend/app', 'no'),
                                Yii::t('backend/app', 'yes'),
                            ], ['class' => 'form-control', 'prompt' => '']),
                        ],
                        [
                            'attribute' => 'created_at',
                            'value'     => function ($model) {
                                return date('Y-m-d H:i:s', $model->created_at);
                            },
                            'filter'    => false,
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value'     => function ($model) {
                                return date('Y-m-d H:i:s', $model->created_at);
                            },
                            'filter'    => false,
                        ],
                        [
                            'class'    => \yii\grid\ActionColumn::class,
                            'header'   => 'Действия',
                            'template' => '{view} {update} {delete}',
                            'buttons'  => [
                                'view' => function ($url) {
                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('backend/app', 'Посмотреть'),
                                    ]);
                                },

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
