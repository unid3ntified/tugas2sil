<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesOrder;

/**
 * SalesOrderSearch represents the model behind the search form about `app\models\SalesOrder`.
 */
class SalesOrderSearch extends SalesOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'delivery', 'discount', 'total'], 'integer'],
            [['timestamp', 'country', 'city', 'street', 'zip', 'status', 'note', 'last_updated'], 'safe'],
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
        $query = SalesOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'timestamp' => $this->timestamp,
            'delivery' => $this->delivery,
            'discount' => $this->discount,
            'total' => $this->total,
            'last_updated' => $this->last_updated,
        ]);

        $query->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
