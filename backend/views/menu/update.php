<?php
/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $rootTitle string */
/* @var $rootId int */
/* @var $pages array */

$this->title = Yii::t('backend/modules/menu/main', 'update_title');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/menu/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $rootTitle, 'url' => ['view?id=' . $rootId]];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
    'pages' => $pages
]);
