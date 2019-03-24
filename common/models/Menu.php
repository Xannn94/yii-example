<?php

namespace common\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menus".
 *
 * @property int    $id
 * @property string $lang
 * @property int    $page_id
 * @property int    $lft
 * @property int    $rgt
 * @property int    $depth
 * @property string $name
 * @property string $slug
 */
class Menu extends ActiveRecord
{
    protected $multiLang = true;

    public static function tableName()
    {
        return '{{%menus}}';
    }

    public function beforeSave($insert)
    {
        $this->lang = Yii::$app->language;

        return parent::beforeSave($insert);
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['lft', 'rgt', 'depth', 'page_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['lang'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'    => Yii::t('backend/app/label', 'title'),
            'page_id' => Yii::t('backend/app/label', 'page'),
            'slug' => Yii::t('backend/app/label', 'slug')
        ];
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
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
        return new MenuQuery(get_called_class());
    }
}
