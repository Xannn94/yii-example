<?php

namespace common\traits;

use Yii;

trait FileModelTrait
{
    public function deleteOldFiles()
    {
        foreach (Yii::$app->params['uploads'][Yii::$app->controller->id] as $field => $params) {
            if ($this->canDelete($field, Yii::$app->controller->action->actionMethod)) {
                $filePath = \Yii::getAlias('@webroot/' . $params['path'] . $this->oldAttributes[$field]);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }

    private function isUpdateAction()
    {
        return Yii::$app->controller->action->actionMethod === 'actionUpdate';
    }

    private function isDeleteAction()
    {
        return Yii::$app->controller->action->actionMethod === 'actionDelete';
    }

    private function canDelete(string $field, string $method) : bool
    {
        switch ($method) {
            case 'actionUpdate':
                $condition = $this->oldAttributes[$field] !== $this->attributes[$field] && !empty($this->oldAttributes[$field]);
                break;
            case 'actionDelete':
                $condition = !empty($this->{$field});
                break;
            default:
                $condition = false;
                break;
        }

        return $condition;
    }
}