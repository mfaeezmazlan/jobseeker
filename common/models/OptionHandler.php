<?php

namespace common\models;

use Yii;

class OptionHandler {

    public static function populate($params = []) {
        $data['yes-no'] = [1 => Yii::t('app', 'Yes'), 0 => Yii::t('app', 'No')];

        return $data;
    }

    public static function render($template, $params = []) {
        $options = [];
        $data = static::populate($params);

        if (isset($data[$template])) {
            if (isset($data[$template]['options'])) {
                if (is_array($data[$template]['options']))
                    $options = $data[$template]['options'];
                else
                    $options = call_user_func($data[$template]['options']);

                if (isset($data[$template]['mirror']) && $data[$template]['mirror']) {
                    $options = static::mirror($options);
                }

                if (isset($data[$template]['shift']) && $data[$template]['shift']) {
                    $options = static::shift($options);
                }
            } else {
                if (is_array($data[$template]))
                    $options = $data[$template];
            }
        }

        return $options;
    }

    public static function resolve($template, $val, $params = []) {
        $options = static::render($template, $params);

        if (isset($options[$val]))
            return $options[$val];
        else
            return null;
    }

    private static function mirror($options) {
        $options = array_combine($options, $options);
        return $options;
    }

    private static function shift($options) {
        array_unshift($options, 'dummy');
        unset($options[0]);
        return $options;
    }

}
