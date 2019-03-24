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
            <div class="col-4">
                <?= $form->field($model, 'slug')->textInput(); ?>
            </div>
            <div class="col-2">
                <?= $form->field($model, 'active')->checkbox(); ?>
            </div>
            <div class="col-2">
                <?= $form->field($model, 'in_menu')->checkbox(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?= $form->field($model, 'content')->widget(Redactor::className(), [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 200,
                        'imageUpload' => Url::to(['/news/image-upload']),
                        'fileUpload' => Url::to(['/news/file-upload']),
                        'plugins' => [
                            'clips',
                            'fullscreen'
                        ]
                    ]
                ]); ?>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
