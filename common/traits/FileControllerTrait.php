<?php

namespace common\traits;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

trait FileControllerTrait
{
    public function upload(ActiveRecord $model)
    {
        foreach (Yii::$app->params['uploads'][$this->id] as $field => $params) {
            $image = UploadedFile::getInstance($this->model, $field);
            if (!is_null($image)) {
                $name = time() . '.' . $image->extension;
                $image->saveAs($params['path'] . $name);
                $model->{$field} = $name;
            }
        }

        $model->save();
    }
}