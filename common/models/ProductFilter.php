<?php

namespace common\models;

use Yii;
use common\traits\FileModelTrait;
use yii\base\ModelEvent;

/**
 * This is the model class for table "product_filter_group".
 *
 * @property int $id
 * @property int $group_id
 * @property string $lang
 * @property string $title
 * @property int $priority
 */
class ProductFilter extends Base
{
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
        return '{{%product_filters}}';
    }

    public function rules()
    {
        return [
            [['title', 'group_id'], 'required'],
            [['lang','priority'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend/app/label', 'id'),
            'title' => Yii::t('backend/app/label', 'title'),
            'group_id' => Yii::t('backend/app/label', 'group_id'),
            'priority' => Yii::t('backend/app/label', 'priority'),
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(ProductFilterGroup::class,['id' => 'group_id']);
    }
}
