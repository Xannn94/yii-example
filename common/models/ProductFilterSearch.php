<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * ProductFilterSearch represents the model behind the search form of `common\models\ProductFilterGroup`.
 */
class ProductFilterSearch extends ProductFilter
{
    public function rules()
    {
        return [
            [['title', 'lang', 'group_id'], 'safe'],
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
        $query        = ProductFilterSearch::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'   => $this->id,
            'lang' => Yii::$app->language
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'group_id', $this->group_id]);

        return $dataProvider;
    }
}
