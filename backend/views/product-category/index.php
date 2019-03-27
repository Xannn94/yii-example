<?php

use backend\widgets\AdminNested;
use backend\assets\ICheckAssets;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $query \yii\db\ActiveQuery */

$this->title = Yii::t('backend/modules/product-category/main', 'title');

$this->params['breadcrumbs'][] = $this->title;

ICheckAssets::register($this);
?>

<div class="card card-primary">
    <div class="card-body">
        <p><?= Html::a(Yii::t('backend/modules/menu/main', 'create_button'), ['create'], ['class' => 'btn btn-default']) ?></p>

        <?= AdminNested::widget([
            'type'          => AdminNested::TYPE_WITH_HANDLE,
            'query'         => $query,
            'modelOptions'  => [
                'name' => 'name', //поле из БД с названием элемента (отображается в дереве)
            ],
            'pluginEvents'  => [
                'change' => 'function(e) {}', //js событие при выборе элемента
            ],
            'pluginOptions' => [
                'maxDepth' => 10, //максимальное кол-во уровней вложенности
            ],
            'update'        => Url::to(['product-category/update']), //действие по обновлению
            'delete'        => Url::to(['product-category/delete']), //действие по удалению
        ]); ?>

        <div id="nestable-menu">
            <button class="btn btn-default" type="button" data-action="expand-all">Развернуть</button>
            <button class="btn btn-default" type="button" data-action="collapse-all">Свернуть</button>
        </div>
    </div>
</div>