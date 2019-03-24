<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $pages array */

$this->title = Yii::t('backend/modules/menu/main', 'create_title');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/menu/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
    'pages' => $pages
]);
