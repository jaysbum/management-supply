<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BudgetPayment;

/**
 * BudgetPaymentSearch represents the model behind the search form about `app\models\BudgetPayment`.
 */
class BudgetPaymentSearch extends BudgetPayment
{
    public $request;
    public $quarter;
    public function rules()
    {
        return [
            [['id', 'request_id', 'month', 'year', 'created_at', 'updated_at'], 'integer'],
            [['total'], 'number'],
            [['payment_date', 'remark','request','quarter'], 'safe'],
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
        $query = BudgetPayment::find()->select("id,request_id,month,year,total,payment_date,CEIL(month/3) AS quarter");
        //$query->addSelect(["*", "ceil(month/3) AS quarter"]);
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
        $dataProvider->sort->attributes['quarter'] = [
            'asc' => ['quarter' => SORT_ASC],
            'desc' => ['quarter' => SORT_DESC],
            'label' => 'ไตรมาส',
            'default' => SORT_ASC
        ];
        // grid filtering conditions
        if($this->quarter > 0){
          $query->having(['quarter' => $this->quarter]);
        }
        if($this->month > 0){
          $query->andFilterWhere(['month' => $this->month]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'request_id' => $this->request_id,
            //'month' => $this->month,
            //'quarter' => $this->quarter,
            'year' => $this->year,
            'total' => $this->total,
            'payment_date' => $this->payment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
