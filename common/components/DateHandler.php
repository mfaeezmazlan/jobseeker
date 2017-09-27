<?php

namespace common\components;

use Yii;

class DateHandler {

    public static function resolveDateRead($date) {
        return date('d/m/Y h:i:s a', strtotime($date));
    }

    public static function resolveDateSave($date) {
        $date = str_replace('/', '-', $date);
        return date('Y-m-d H:i:s', strtotime($date));
    }

}
