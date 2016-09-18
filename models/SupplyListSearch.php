<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SupplyList;

/**
 * SupplyListSearch represents the model behind the search form about `app\models\SupplyList`.
 */
class SupplyListSearch extends SupplyList
{
    public function rules()
    {
        return [
            [['id', 'group_id', 'quantity', 'real_quantity', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'nsn', 'unit_issue', 'gpsc', 'remark'], 'safe'],
            //[['price', 'total', 'real_price', 'real_total', 'margin_total'], 'number'],
            [['price','real_price'], 'number'],
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
        $query = SupplyList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'group_id' => $this->group_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            //'total' => $this->total,
            'real_price' => $this->real_price,
            'real_quantity' => $this->real_quantity,
            //'real_total' => $this->real_total,
            //'margin_total' => $this->margin_total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nsn', $this->nsn])
            ->andFilterWhere(['like', 'unit_issue', $this->unit_issue])
            ->andFilterWhere(['like', 'gpsc', $this->gpsc])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
