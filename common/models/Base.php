<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Base extends ActiveRecord
{
    protected $multiLang = false;

    /**
     * Если необходимо загружать файлы нужно заполнить конфиг params.php
     * и подключить трейт common/traits/FileModelTrait.
     * Также нужно подключить трейт common/traits/FileControllerTrait в ваш Контроллер
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->updated_at = time();
        if (method_exists($this,'deleteOldFiles')) {
            $this->deleteOldFiles();
        }

        if ($insert) {
            $this->created_at = time();
        }

        if ($this->multiLang) {
            $this->lang = Yii::$app->language;
        }

        return parent::beforeSave($insert);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function beforeDelete()
    {
        if (method_exists($this,'deleteOldFiles')) {
            $this->deleteOldFiles();
        }

        return parent::beforeDelete();
    }
}