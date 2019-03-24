<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "widgets".
 *
 * @property int    $id
 * @property string $lang
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int    $active
 * @property string $type
 * @property int    $created_at
 * @property int    $updated_at
 */
class Widget extends Base
{
    protected $multiLang = true;

    public static function tableName()
    {
        return '{{%widgets}}';
    }

    public function rules()
    {
        return [
            [['title', 'slug', 'content', 'type'], 'required'],
            [['title', 'slug', 'content', 'type'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'type'], 'string', 'max' => 255],
            [['slug', 'lang'], 'unique', 'targetAttribute' => ['slug', 'lang']],
            [['active', 'lang'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('backend/app/label', 'id'),
            'title'      => Yii::t('backend/app/label', 'title'),
            'slug'       => Yii::t('backend/app/label', 'slug'),
            'content'    => Yii::t('backend/app/label', 'content'),
            'active'     => Yii::t('backend/app/label', 'active'),
            'type'       => Yii::t('backend/app/label', 'type'),
            'created_at' => Yii::t('backend/app/label', 'created_at'),
            'updated_at' => Yii::t('backend/app/label', 'updated_at'),
        ];
    }
}
