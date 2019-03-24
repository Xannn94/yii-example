<?php

/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model \common\models\News */

/* @var $pages array */

use backend\assets\ICheckAssets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

ICheckAssets::register($this);
?>
<div class="card card-primary">
    <?php $form = ActiveForm::begin([
        'options'     => ['role' => 'form'],
        'fieldConfig' => [
            'template'         => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'checkboxTemplate' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}"
        ],
    ]); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'name')->textInput(); ?>
            </div>

            <div class="col-4">
                <?= $form->field($model, 'page_id')->dropDownList($pages); ?>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
