<?php

namespace api\modules\hr;

use Yii;
use yii\filters\RateLimiter;

class Module extends \yii\base\Module
{
    /** @var string */
    public $controllerNamespace = 'api\modules\hr\controllers';
    public $defaultRoute = 'site/index';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->identityClass = 'api\modules\hr\models\ApiUserIdentity';
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::class,
        ];

        return $behaviors;
    }
}
