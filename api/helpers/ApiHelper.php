<?php

namespace api\helpers;

/**
 * Class ApiHelper
 * @package api\helpers
 */
class ApiHelper
{
    public static function printErrors($errors)
    {
        if (YII_ENV_DEV) {
            echo '<pre>';
            var_dump($errors);
            echo '</pre>';
            die;
        }
    }
}