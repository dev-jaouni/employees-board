<?php

namespace backend\modules\rbac;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * rbac-crud module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\rbac\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!Yii::$app->user->can('administrator')) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        parent::init();

        // custom initialization code goes here
    }
}
