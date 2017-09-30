<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\JobList;

/**
 * JobListSearch represents the model behind the search form about `common\models\JobList`.
 */
class JobListSearch extends JobList {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'company_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['field', 'position', 'description', 'isDeleted', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['salary'], 'number'],
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
    public function search($params, $join = false) {
        $query = JobList::find();
        if ($join)
            $query->innerJoin('job_application', 'job_list.id=job_application.job_list_id')->andWhere(['job_application.user_id' => Yii::$app->user->id]);

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
            'salary' => $this->salary,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'field', $this->field])
                ->andFilterWhere(['like', 'position', $this->position])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'isDeleted', $this->isDeleted]);

        return $dataProvider;
    }

}
