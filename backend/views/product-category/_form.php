<?php

/* @var $form ActiveForm */
/* @var $this View */
/* @var $model \common\models\ProductCategory */

/* @var $pages array */

use backend\assets\ICheckAssets;
use backend\assets\Select2Assets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

ICheckAssets::register($this);
Select2Assets::register($this);

$js = <<<JS
    $('.select2').select2();
JS;

$this->registerJs($js, View::POS_END);

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
                <?= $form->field($model, 'slug')->textInput(); ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'active')->checkbox(); ?>
            </div>
        </div>
        <?php if (count($parentList)): ?>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model,'parent_id')->dropDownList($parentList,['class'=>'form-control select2']) ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
