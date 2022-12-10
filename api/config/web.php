<?php
use common\components\Helper;

$config = [
    'id' => Helper::SITE_API_APP_ID,
    'basePath' => dirname(__DIR__),
    'homeUrl' => Yii::getAlias('@apiUrl'),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'site/redirect',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'employee' => \api\modules\employee\Module::class,
        'hr' => \api\modules\hr\Module::class,
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => common\components\maintenance\Maintenance::class,
            'enabled' => function ($app) {
                if (env('APP_MAINTENANCE') === '1') {
                    return true;
                }
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
        'user' => [
            'identityClass' => common\models\User::class,
            'loginUrl' => null,
            'enableAutoLogin' => true,
            'enableSession' => false,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ]
    ]
];

return $config;
