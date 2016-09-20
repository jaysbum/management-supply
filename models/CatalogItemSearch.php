<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatalogItem;

/**
 * CatalogItemSearch represents the model behind the search form about `app\models\CatalogItem`.
 */
class CatalogItemSearch extends CatalogItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'new', 'niin'], 'integer'],
            [['nsn', 'name', 'unit_issue', 'gpsc', 'remark'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = CatalogItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
              'defaultOrder' => [
                    'id' => SORT_DESC,
              ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'new' => $this->new,
            'niin' => $this->niin
        ]);

        $query->andFilterWhere(['like', 'nsn', $this->nsn])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit_issue', $this->unit_issue])
            ->andFilterWhere(['like', 'gpsc', $this->gpsc])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
