<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = Yii::t('backend/modules/page/main', 'create_title');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/page/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
]);
