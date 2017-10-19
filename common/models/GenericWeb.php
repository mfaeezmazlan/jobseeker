<?php

namespace common\models;

use Yii;
use backend\models\User as BackendUser;

class GenericWeb extends \yii\db\ActiveRecord {

    public function beforeSave($insert) {
        if (Yii::$app->user->isGuest) {
            if (parent::beforeSave($insert)) {
                if (!defined('STDIN')) {
                    $user = BackendUser::find()->where("username='guest'")->one();
                }
                if ($this->isNewRecord) {
                    $this->updated_at = $this->created_at = date('Y-m-d H:i:s');
                    if (!defined('STDIN')) {
                        $this->updated_by = $this->created_by = Yii::$app->user->id;
                    } else {
                        $this->updated_by = -99;
                    }
                } else {
                    //$this->created_at= date('Y-m-d H:i:s'); 
                    if ($this->isDeleted == "1") {
                        $this->deleted_at = date('Y-m-d H:i:s');
                        if (!empty($user)) {
                            if (!defined('STDIN')) {
                                $this->deleted_by = Yii::$app->user->id;
                            } else {
                                $this->deleted_by = -99;
                            }
                        } else {
                            $this->deleted_by = -99;
                        }
                    } else {
                        $this->updated_at = date('Y-m-d H:i:s');
                        if (!empty($user)) {
                            if (!defined('STDIN')) {
                                $this->updated_by = Yii::$app->user->id;
                            } else {
                                $this->updated_by = -99;
                            }
                        } else {
                            $this->updated_by = -99;
                        }
                    }
                }
                $user = null;
                return true;
            } else {
                return false;
            }
        } else {
            if (parent::beforeSave($insert)) {
                if (!defined('STDIN')) {
                    $user = BackendUser::find()->where("username='" . Yii::$app->user->identity->username . "'")->one();
                }
                if ($this->isNewRecord) {
                    $this->updated_at = $this->created_at = date('Y-m-d H:i:s');
                    if (!defined('STDIN')) {
                        $this->updated_by = $this->created_by = Yii::$app->user->id;
                    } else {
                        $this->updated_by = -99;
                    }
                } else {
                    //$this->created_at= date('Y-m-d H:i:s'); 
                    if ($this->isDeleted == "1") {
                        $this->deleted_at = date('Y-m-d H:i:s');
                        if (!empty($user)) {
                            if (!defined('STDIN')) {
                                $this->deleted_by = Yii::$app->user->id;
                            } else {
                                $this->deleted_by = -99;
                            }
                        } else {
                            $this->deleted_by = -99;
                        }
                    } else {
                        $this->updated_at = date('Y-m-d H:i:s');
                        if (!empty($user)) {
                            if (!defined('STDIN')) {
                                $this->updated_by = Yii::$app->user->id;
                            } else {
                                $this->updated_by = -99;
                            }
                        } else {
                            $this->updated_by = -99;
                        }
                    }
                }
                $user = null;
                return true;
            } else {
                return false;
            }
        }
    }

}
