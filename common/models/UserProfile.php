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
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile_no
 * @property string $home_no
 * @property string $description
 * @property string $is_deleted
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
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'address_id', 'profile_pic_id', 'first_name', 'last_name'], 'required'],
            [['user_id', 'address_id', 'profile_pic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['mobile_no', 'home_no'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 1024],
            [['is_deleted'], 'string', 'max' => 1],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'profile_pic_id' => Yii::t('app', 'Profile Pic ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'home_no' => Yii::t('app', 'Home No'),
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
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
