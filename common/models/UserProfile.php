<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $address_id
 * @property integer $profile_pic_id
 * @property string $nric
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile_no
 * @property string $home_no
 * @property string $description
 * @property string $skills
 * @property string $language
 * @property string $gender
 * @property string $area_of_education
 * @property string $date_of_birth
 * @property string $marital_status
 * @property string $qualification
 * @property string $leadership_experience
 * @property string $previous_job_field
 * @property string $working_experience
 * @property string $expected_salary
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property Address $address
 * @property User $user
 */
class UserProfile extends \common\models\GenericWeb {

    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'address_id', 'profile_pic_id', 'first_name'], 'required'],
            [['user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['skills', 'language', 'date_of_birth', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['expected_salary'], 'number'],
            [['file'], 'file'],
            [['nric', 'mobile_no', 'home_no'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'leadership_experience'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['gender', 'area_of_education', 'marital_status', 'qualification', 'previous_job_field', 'working_experience'], 'string', 'max' => 30],
            [['isDeleted'], 'string', 'max' => 1],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'profile_pic_id' => Yii::t('app', 'Profile Pic ID'),
            'nric' => Yii::t('app', 'Nric'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'home_no' => Yii::t('app', 'Home No'),
            'description' => Yii::t('app', 'Description'),
            'skills' => Yii::t('app', 'Skills'),
            'language' => Yii::t('app', 'Language'),
            'gender' => Yii::t('app', 'Gender'),
            'file' => Yii::t('app', 'Resume'),
            'area_of_education' => Yii::t('app', 'Area Of Education'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'qualification' => Yii::t('app', 'Qualification'),
            'leadership_experience' => Yii::t('app', 'Leadership Experience'),
            'previous_job_field' => Yii::t('app', 'Previous Job Field'),
            'working_experience' => Yii::t('app', 'Working Experience'),
            'expected_salary' => Yii::t('app', 'Expected Salary'),
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
    public function getAddress() {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getFullName(){
        return $this->first_name . " " . $this->last_name;
    }
    
    
    public function getDoc() {
        return $this->hasMany(UserDoc::className(), ['user_id' => 'user_id']);
    }
}
