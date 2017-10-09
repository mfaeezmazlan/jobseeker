<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%doc_attach}}".
 *
 * @property integer $id
 * @property string $doc_title
 * @property string $file_name
 * @property string $file_name_sys
 * @property string $file_type
 * @property string $remarks
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class DocAttach extends \common\models\GenericWeb {

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%doc_attach}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['doc_title', 'file_name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['file'], 'file'],
            [['doc_title', 'file_name', 'file_name_sys'], 'string', 'max' => 100],
            [['file_type'], 'string', 'max' => 50],
            [['remarks'], 'string', 'max' => 255],
            [['isDeleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'doc_title' => Yii::t('app', 'Doc Title'),
            'file_name' => Yii::t('app', 'File Name'),
            'file' => Yii::t('app', 'Resume'),
            'file_name_sys' => Yii::t('app', 'File Name Sys'),
            'file_type' => Yii::t('app', 'File Type'),
            'remarks' => Yii::t('app', 'Remarks'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    public static function getImage($id, $generalPath, $sizeWidth = "100px") {
        $data = self::find()->where(["id" => $id])->one();
        if ($data) {
            if (preg_match('/image/', $data->file_type)) {
                $completePath = $generalPath . "/" . $data->file_name_sys;
                return "<img src='$completePath' title='$data->doc_title' width='$sizeWidth' />";
            } else {
                return "<a href='#'>$data->doc_title</a>";
            }
        }
    }

    public static function getNotificationImage($id, $generalPath, $sizeWidth = "100px") {
        $data = self::find()->where(["id" => $id])->one();
        if ($data) {
            if (preg_match('/image/', $data->file_type)) {
                $completePath = $generalPath . "/" . $data->file_name_sys;
                return $completePath;
            }
        }
        return null;
    }

}
