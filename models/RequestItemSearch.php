<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestItem;

/**
 * RequestItemSearch represents the model behind the search form about `app\models\RequestItem`.
 */
class RequestItemSearch extends RequestItem
{
    public $supply;
    public $budget;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supply_id', 'request_id', 'budget_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['budget', 'supply'], 'safe'],
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
        $query = RequestItem::find();

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
            'supply_id' => $this->supply_id,
            'request_id' => $this->request_id,
            'budget_id' => $this->budget_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
