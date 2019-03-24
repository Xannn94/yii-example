<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $pages array */
/* @var $rootTitle string */
/* @var $rootId int */
/* @var $createUrl string */
/* @var $canCreate bool */

use backend\widgets\AdminNested;
use backend\assets\ICheckAssets;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('backend/modules/menu/main', 'list_root_title', ['title' => $rootTitle]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/menu/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

ICheckAssets::register($this);
?>

<div class="card card-primary">
    <div class="card-body">
        <?php if ($canCreate): ?>
            <p><?= Html::a(Yii::t('backend/modules/menu/main', 'create_button'), [$createUrl], ['class' => 'btn btn-default']) ?></p>
        <?php endif; ?>

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
            'update'        => Url::toRoute(['menu/update', 'root' =>  $rootId]), //действие по обновлению
            'delete'        => Url::to(['menu/delete']), //действие по удалению
        ]); ?>

        <div id="nestable-menu">
            <button class="btn btn-default" type="button" data-action="expand-all">Развернуть</button>
            <button class="btn btn-default" type="button" data-action="collapse-all">Свернуть</button>
        </div>
    </div>
</div>
