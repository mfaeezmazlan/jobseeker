<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref}}".
 *
 * @property string $id
 * @property string $cat
 * @property string $code
 * @property string $descr
 * @property string $param1
 * @property string $param2
 * @property string $sort
 * @property string $isDeleted
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $deleted_at
 * @property string $deleted_by
 */
class Reference extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%ref}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cat', 'code', 'descr'], 'required'],
            [['sort', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['cat', 'code'], 'string', 'max' => 30],
            [['descr', 'param1', 'param2'], 'string', 'max' => 50],
            [['isDeleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'cat' => Yii::t('app', 'Category'),
            'code' => Yii::t('app', 'Code'),
            'descr' => Yii::t('app', 'Description'),
            'param1' => Yii::t('app', 'Parameter 1'),
            'param2' => Yii::t('app', 'Parameter 2'),
            'sort' => Yii::t('app', 'Sort'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    public static function getList($cat, $param1 = null, $param2 = null) {
        $arr = array();

        if ($param1 != null && $param2 != null) {
            $data = self::find()->where(['cat' => $cat, 'param1' => $param1, 'param2' => $param2, 'isDeleted' => 0])->orderBy(['sort' => SORT_ASC, 'descr' => SORT_ASC])->all();
        } else if ($param1 != null) {
            $data = self::find()->where(['cat' => $cat, 'param1' => $param1, 'isDeleted' => 0])->orderBy(['sort' => SORT_ASC, 'descr' => SORT_ASC])->all();
        } else if ($param2 != null) {
            $data = self::find()->where(['cat' => $cat, 'param2' => $param2, 'isDeleted' => 0])->orderBy(['sort' => SORT_ASC, 'descr' => SORT_ASC])->all();
        } else {
            $data = self::find()->where(['cat' => $cat, 'isDeleted' => 0])->orderBy(['sort' => SORT_ASC, 'descr' => SORT_ASC])->all();
        }

        foreach ($data as $x) {
            $arr[$x->code] = $x->descr;
        }
        return $arr;
    }

    public static function getDesc($cat, $code) {
        $data = self::find()->where(['cat' => $cat, 'code' => $code])->one();
        return $data->descr;
    }

}
