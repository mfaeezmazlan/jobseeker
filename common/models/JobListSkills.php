<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%job_list_skills}}".
 *
 * @property integer $id
 * @property integer $job_list_id
 * @property string $skills_name
 * @property string $description
 * @property string $is_deleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property JobList $jobList
 */
class JobListSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%job_list_skills}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_list_id', 'skills_name'], 'required'],
            [['job_list_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['skills_name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['is_deleted'], 'string', 'max' => 1],
            [['job_list_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobList::className(), 'targetAttribute' => ['job_list_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_list_id' => Yii::t('app', 'Job List ID'),
            'skills_name' => Yii::t('app', 'Skills Name'),
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
    public function getJobList()
    {
        return $this->hasOne(JobList::className(), ['id' => 'job_list_id']);
    }
}
