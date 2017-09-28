<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserProfile;

/**
 * UserProfileSearch represents the model behind the search form about `common\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by', 'working_experience'], 'integer'],
            [['min_salary', 'max_salary', 'expected_salary'], 'number'],
            [['first_name', 'qualification', 'skills', 'language', 'previous_job_field', 'leadership_experience', 'date_of_birth', 'last_name', 'mobile_no', 'home_no', 'description', 'isDeleted', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = UserProfile::find();

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

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
                ->andFilterWhere(['like', 'home_no', $this->home_no])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }

    public function searchTalent($params) {
        $query = UserProfile::find()->innerJoin('auth_assignment a', 'a.user_id = user_profile.user_id')->where('a.item_name="employee"');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($params['UserProfileSearch'])) {
            if (is_array($params['UserProfileSearch']['skills'])) {
                $params['UserProfileSearch']['skills'] = implode(',', $params['UserProfileSearch']['skills']);
            }
            if (is_array($params['UserProfileSearch']['language'])) {
                $params['UserProfileSearch']['language'] = implode(',', $params['UserProfileSearch']['language']);
            }
            if (is_array($params['UserProfileSearch']['leadership_experience'])) {
                $params['UserProfileSearch']['leadership_experience'] = implode(',', $params['UserProfileSearch']['leadership_experience']);
            }
        }

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
            'qualification' => $this->qualification,
            'working_experience' => $this->working_experience,
            'previous_job_field' => $this->previous_job_field,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
                ->andFilterWhere(['like', 'home_no', $this->home_no])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        $query->andFilterWhere(['between', 'expected_salary', $this->min_salary, $this->max_salary]);

        $skillsArr = explode(',', $this->skills);
        $leadership_experienceArr = explode(',', $this->leadership_experience);
        $languageArr = explode(',', $this->language);
        foreach ($skillsArr as $skills) {
            $query->andFilterWhere(['like', 'skills', $skills]);
        }
        foreach ($leadership_experienceArr as $leadership) {
            $query->andFilterWhere(['like', 'leadership_experience', $leadership]);
        }
        foreach ($languageArr as $language) {
            $query->andFilterWhere(['like', 'language', $language]);
        }

        return $dataProvider;
    }

}
