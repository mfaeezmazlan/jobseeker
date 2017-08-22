<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%job_list}}".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $position
 * @property string $description
 * @property string $is_deleted
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
class JobList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'title', 'position'], 'required'],
            [['company_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title', 'position'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['is_deleted'], 'string', 'max' => 1],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'title' => Yii::t('app', 'Title'),
            'position' => Yii::t('app', 'Position'),
            'description' => Yii::t('app', 'Description'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
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
    public function getCompany()
    {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobListSkills()
    {
        return $this->hasMany(JobListSkills::className(), ['job_list_id' => 'id']);
    }
}
