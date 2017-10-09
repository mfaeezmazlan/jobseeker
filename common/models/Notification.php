<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%notification}}".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string $status
 * @property string $message
 * @property string $path
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class Notification extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%notification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['from', 'to'], 'required'],
            [['from', 'to', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status', 'isDeleted'], 'string', 'max' => 1],
            [['message'], 'string', 'max' => 1024],
            [['path'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'status' => Yii::t('app', 'Status'),
            'message' => Yii::t('app', 'Message'),
            'path' => Yii::t('app', 'Path'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

}
