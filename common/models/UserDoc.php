<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_doc}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $doc_attach_id
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class UserDoc extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_doc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'doc_attach_id'], 'required'],
            [['user_id', 'doc_attach_id', 'created_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'updated_by', 'deleted_at'], 'safe'],
            [['isDeleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'doc_attach_id' => Yii::t('app', 'Doc Attach ID'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }
    
    public function getDocAttach(){
        return $this->hasOne(DocAttach::className(), ['id' => 'doc_attach_id']);
    }
}
