<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%company_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $address_id
 * @property integer $profile_pic_id
 * @property string $company_name
 * @property string $registration_no
 * @property string $mobile_no
 * @property string $office_no
 * @property string $description
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
 * @property JobList[] $jobLists
 */
class CompanyProfile extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%company_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'address_id', 'profile_pic_id', 'company_name', 'registration_no'], 'required'],
            [['user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['company_name', 'registration_no'], 'string', 'max' => 100],
            [['mobile_no', 'office_no'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 1024],
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
            'company_name' => Yii::t('app', 'Company Name'),
            'registration_no' => Yii::t('app', 'Registration No'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'office_no' => Yii::t('app', 'Office No'),
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
    public function getAddress() {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobLists() {
        return $this->hasMany(JobList::className(), ['company_id' => 'id']);
    }
    
    public static function getList(){
        $arr = [];
        $data = self::find()->where(['isDeleted' => '0'])->all();
        foreach ($data as $x){
            $arr[$x->id] = $x->company_name;
        }
        return $arr;
    }
}
