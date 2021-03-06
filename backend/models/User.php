<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $repeat_password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 *
 * @property CompanyProfile[] $companyProfiles
 * @property UserProfile[] $userProfiles
 */
class User extends \common\models\GenericWeb {

    public $repeat_password;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email', 'password'], 'required'],
            [['email'], 'email'],
            [['username','email'], 'unique'],
            [['username', 'email', 'password', 'repeat_password'], 'required', 'on' => 'register'],
            [['password', 'repeat_password'], 'string', 'min' => 6, 'on' => 'register'],
            [['repeat_password'], 'compare', 'compareAttribute' => 'password', 'message' => 'Password did not match', 'on' => 'register'],
            [['status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['username', 'password', 'password_hash', 'password_reset_token', 'email', 'auth_key'], 'string', 'max' => 255],
            [['isDeleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'repeat_password' => Yii::t('app', 'Repeat Password'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
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
    public function getCompanyProfiles() {
        return $this->hasMany(CompanyProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile() {
        return $this->hasOne(\common\models\UserProfile::className(), ['user_id' => 'id']);
    }

}
