<?php
/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */

$this->title = Yii::t('backend/modules/product-category/main', 'create_title');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/product-category/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
    'parentList' => $parentList
]);
