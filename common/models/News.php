<?php

namespace common\models;

use Yii;
use common\traits\FileModelTrait;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property string $image
 * @property int $active
 * @property int $created_at
 * @property int $updated_at
 */
class News extends Base
{
    use FileModelTrait;

    protected $multiLang = true;

    public static function tableName()
    {
        return '{{%news}}';
    }

    public function rules()
    {
        return [
            [['title', 'preview', 'content'], 'required'],
            [['title', 'preview', 'content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['active', 'lang'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend/app/label', 'id'),
            'title' => Yii::t('backend/app/label', 'title'),
            'preview' => Yii::t('backend/app/label', 'preview'),
            'content' => Yii::t('backend/app/label', 'content'),
            'image' => Yii::t('backend/app/label', 'image'),
            'active' => Yii::t('backend/app/label', 'active'),
            'created_at' => Yii::t('backend/app/label', 'created_at'),
            'updated_at' => Yii::t('backend/app/label', 'updated_at'),
        ];
    }
}
