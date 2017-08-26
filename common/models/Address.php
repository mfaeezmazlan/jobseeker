<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $country
 * @property integer $state
 * @property integer $district
 * @property string $city
 * @property string $street_1
 * @property string $street_2
 * @property string $postcode
 * @property string $is_deleted
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
class Address extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'country', 'street_1'], 'required'],
            [['type', 'country', 'state', 'district', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['city', 'street_1', 'street_2'], 'string', 'max' => 100],
            [['postcode'], 'string', 'max' => 50],
            [['is_deleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'country' => Yii::t('app', 'Country'),
            'state' => Yii::t('app', 'State'),
            'district' => Yii::t('app', 'District'),
            'city' => Yii::t('app', 'City'),
            'street_1' => Yii::t('app', 'Street 1'),
            'street_2' => Yii::t('app', 'Street 2'),
            'postcode' => Yii::t('app', 'Postcode'),
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
    public function getAddressCountry() {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressState() {
        return $this->hasOne(States::className(), ['id' => 'state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyProfiles() {
        return $this->hasMany(CompanyProfile::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles() {
        return $this->hasMany(UserProfile::className(), ['address_id' => 'id']);
    }

    public function getFullAddress() {
        $arr = array();
        if ($this->street_1)
            $arr[] = $this->street_1;
        if ($this->street_2)
            $arr[] = $this->street_2;
        if ($this->postcode)
            $arr[] = $this->postcode;
        if ($this->addressCity)
            $arr[] = $this->addressCity->name;
        if ($this->addressState)
            $arr[] = $this->addressState->name;

        $arr[] = $this->addressCountry->name;

        return implode(',<br>', $arr);
    }

}
