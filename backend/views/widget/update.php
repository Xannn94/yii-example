<?php
/* @var $this yii\web\View */
/* @var $model common\models\Widget */

$this->title = Yii::t('backend/modules/widget/main', 'update_title');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/modules/widget/main', 'title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
        'model' => $model,
    ]);
