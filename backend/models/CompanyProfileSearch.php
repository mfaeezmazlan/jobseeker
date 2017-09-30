<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyProfile;

/**
 * CompanyProfileSearch represents the model behind the search form about `common\models\CompanyProfile`.
 */
class CompanyProfileSearch extends CompanyProfile {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['company_name', 'registration_no', 'mobile_no', 'office_no', 'description', 'isDeleted', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
    public function search($params, $user_id = null) {
        $query = CompanyProfile::find();
        if ($user_id)
            $query->andWhere(['user_id' => $user_id]);
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
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'profile_pic_id' => $this->profile_pic_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
                ->andFilterWhere(['like', 'registration_no', $this->registration_no])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
                ->andFilterWhere(['like', 'office_no', $this->office_no])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }

}
