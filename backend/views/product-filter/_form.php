<?php

/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */

/* @var $model \common\models\News */

use backend\assets\ICheckAssets;
use vova07\imperavi\Widget as Redactor;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

ICheckAssets::register($this);
?>
<div class="card card-primary">
    <?php $form = ActiveForm::begin([
        'options'     => ['role' => 'form'],
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'checkboxTemplate' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}"
        ],
    ]); ?>

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'title')->textInput(); ?>
            </div>
            <div class="col-5">
                <?= $form->field($model, 'group_id')->dropDownList($this->params['groupSelect']); ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'priority')->textInput(); ?>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
