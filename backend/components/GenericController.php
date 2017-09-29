<?php

namespace backend\components;

class GenericController extends \yii\web\Controller {

    public function beforeAction($event) {
        \common\models\SystemLog::log();
        return parent::beforeAction($event);
    }

}
