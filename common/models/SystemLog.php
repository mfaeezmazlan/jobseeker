<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%system_log}}".
 *
 * @property string $id
 * @property string $ip_address
 * @property integer $user_id
 * @property string $controller
 * @property string $action
 * @property string $description
 * @property string $isDeleted
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class SystemLog extends \common\models\GenericWeb {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 50],
            [['controller', 'action'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1024],
            [['isDeleted'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'user_id' => Yii::t('app', 'User ID'),
            'controller' => Yii::t('app', 'Controller'),
            'action' => Yii::t('app', 'Action'),
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

    public static function log() {
        $description_val = null;
        $description_val .= print_r($_REQUEST, TRUE);
        

        $log = new SystemLog();
        $log->ip_address = $_SERVER['REMOTE_ADDR'];
        $log->controller = Yii::$app->controller->id;
        $log->action = Yii::$app->controller->action->id;
        $log->description = preg_replace('/\s+/', '', $description_val);;

        if (!Yii::$app->user->isGuest) {
            $log->user_id = Yii::$app->user->id;
        } else {
            $log->user_id = 0;
        }

        $log->save();
    }

}
