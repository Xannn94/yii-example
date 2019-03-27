<?php

namespace common\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_categories".
 *
 * @property int    $id
 * @property int    $parent_id
 * @property string $lang
 * @property int    $lft
 * @property int    $rgt
 * @property int    $depth
 * @property string $name
 * @property string $slug
 * @property int $active
 */
class ProductCategory extends ActiveRecord
{
    protected $multiLang = true;

    public static function tableName()
    {
        return '{{%product_categories}}';
    }

    public function beforeSave($insert)
    {
        $this->lang = Yii::$app->language;

        return parent::beforeSave($insert);
    }

    public function rules()
    {
        return [
            [['name','slug'], 'required'],
            [['name'], 'string'],
            [['lft', 'rgt', 'depth', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['lang', 'active'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'    => Yii::t('backend/app/label', 'title'),
            'slug' => Yii::t('backend/app/label', 'slug'),
            'active' => Yii::t('backend/app/label', 'active'),
            'parent_id' => Yii::t('backend/modules/product-category/main','parent_category')
        ];
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
    }
}
