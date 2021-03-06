<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%job_list}}".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $field
 * @property string $position
 * @property string $salary
 * @property string $description
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property CompanyProfile $company
 * @property JobListSkills[] $jobListSkills
 */
class JobList extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%job_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['company_id', 'field', 'position', 'salary'], 'required'],
            [['company_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['skills_require', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['field', 'position'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['isDeleted'], 'string', 'max' => 1],
            [['salary'], 'number'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company'),
            'field' => Yii::t('app', 'Job Field'),
            'position' => Yii::t('app', 'Job Position'),
            'salary' => Yii::t('app', 'Salary'),
            'description' => Yii::t('app', 'Description'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany() {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
    }

}
