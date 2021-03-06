<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $address_id
 * @property integer $company_profile_id
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
 * @property integer $working_experience
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
    public $min_salary, $max_salary;
    public $score;
    public $percentage;

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
            [['user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by', 'working_experience', 'company_profile_id'], 'integer'],
            [['percentage','skills', 'language', 'leadership_experience', 'date_of_birth', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['expected_salary', 'min_salary', 'max_salary', 'score'], 'number'],
            [['file'], 'file'],
            [['nric', 'mobile_no', 'home_no'], 'string', 'max' => 50],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['gender', 'area_of_education', 'marital_status', 'qualification', 'previous_job_field'], 'string', 'max' => 30],
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
            'company_profile_id' => Yii::t('app', 'Company Profile ID'),
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
            'percentage' => Yii::t('app', 'Percentage'),
            'area_of_education' => Yii::t('app', 'Area Of Education'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'qualification' => Yii::t('app', 'Highest Qualification'),
            'leadership_experience' => Yii::t('app', 'Leadership Experience'),
            'previous_job_field' => Yii::t('app', 'Previous Job Field'),
            'working_experience' => Yii::t('app', 'Year of Working Experience'),
            'expected_salary' => Yii::t('app', 'Expected Salary'),
            'min_salary' => Yii::t('app', 'Minimum Salary'),
            'max_salary' => Yii::t('app', 'Maximum Salary'),
            'score' => Yii::t('app', 'Score'),
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

    public function getFullName() {
        return $this->first_name . " " . $this->last_name;
    }

    public function getCompany() {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_profile_id']);
    }

    public function getDoc() {
        return $this->hasMany(UserDoc::className(), ['user_id' => 'user_id']);
    }

    public function getCriteriaPercentage() {
        $score = 0;
        if ($this->qualification == Yii::$app->session->get('qualificationSearch') && Yii::$app->session->get('qualificationSearch') != '')
            $score++;
        if ($this->previous_job_field == Yii::$app->session->get('previousJobFieldSearch') && Yii::$app->session->get('previousJobFieldSearch') != '')
            $score++;
        if ($this->working_experience == Yii::$app->session->get('workingExperienceSearch') && Yii::$app->session->get('workingExperienceSearch') != '')
            $score++;

        if ($this->skills != '' || $this->skills != null) {
            $arr1 = explode(',', $this->skills);
            $arr2 = explode(',', Yii::$app->session->get('skillsSearch'));
            $intersect = array_intersect($arr1, $arr2);
            $score = $score + count($intersect);
        }

        if ($this->language != '' || $this->language != null) {
            $arr1 = explode(',', $this->language);
            $arr2 = explode(',', Yii::$app->session->get('languageSearch'));
            $intersect = array_intersect($arr1, $arr2);
            $score = $score + count($intersect);
        }

        if ($this->leadership_experience != '' || $this->leadership_experience != null) {
            $arr1 = explode(',', $this->leadership_experience);
            $arr2 = explode(',', Yii::$app->session->get('leadershipExpSearch'));
            $intersect = array_intersect($arr1, $arr2);
            $score = $score + count($intersect);
        }

        $totalSearch = Yii::$app->session->get('totalSearch');
        if ($totalSearch == 0) {
            $this->percentage = '100%';
            return $this->percentage;
        } else {
            $this->percentage = number_format((($score / Yii::$app->session->get('totalSearch')) * 100), 2) . "%";
            return $this->percentage;
        }
    }

}
