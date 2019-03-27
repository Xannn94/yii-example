<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * ProductFilterGroupSearch represents the model behind the search form of `common\models\ProductFilterGroup`.
 */
class ProductFilterGroupSearch extends ProductFilterGroup
{
    public function rules()
    {
        return [
            [['title','lang'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductFilterGroupSearch::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'lang' => Yii::$app->language
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
