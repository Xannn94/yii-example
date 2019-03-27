<?php

namespace common\models;

use Yii;
use common\traits\FileModelTrait;
use yii\base\ModelEvent;

/**
 * This is the model class for table "product_filter_group".
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 */
class ProductFilterGroup extends Base
{
    use FileModelTrait;

    protected $multiLang = true;

    public function beforeSave($insert)
    {
        $event = new ModelEvent();
        $this->trigger($insert ? self::EVENT_BEFORE_INSERT : self::EVENT_BEFORE_UPDATE, $event);

        return $event->isValid;
    }

    public function behaviors()
    {
        return [];
    }

    public static function tableName()
    {
        return '{{%product_filter_groups}}';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['lang'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend/app/label', 'id'),
            'title' => Yii::t('backend/app/label', 'title')
        ];
    }
}
