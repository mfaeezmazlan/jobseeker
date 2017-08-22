<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Address;

/**
 * AddressSearch represents the model behind the search form about `common\models\Address`.
 */
class AddressSearch extends Address {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type', 'country', 'state', 'district', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['city', 'street_1', 'street_2', 'postcode', 'is_deleted', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Address::find();

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
            'type' => $this->type,
            'country' => $this->country,
            'state' => $this->state,
            'district' => $this->district,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
                ->andFilterWhere(['like', 'street_1', $this->street_1])
                ->andFilterWhere(['like', 'street_2', $this->street_2])
                ->andFilterWhere(['like', 'postcode', $this->postcode])
                ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }

}
