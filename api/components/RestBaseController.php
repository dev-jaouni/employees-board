<?php

namespace api\components;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class RestBaseController extends Controller
{
    public $language;
    public $requestParams;
    public $roles = [];

    public function init()
    {
        parent::init();

        $this->language = \Yii::$app->language = \Yii::$app->request->headers['lang'];
        $this->requestParams = array_merge(
            Yii::$app->request->post(),
            Yii::$app->request->get(),
            [
                'lang' => $this->language,
            ]
        );
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
            ],
            'except' => [
                'login', // AuthController/login
                'register', // AuthController/register
                'refresh-token', // AuthController/refreshToken
            ],
            'optional' => [
            ],
        ];

        return $behaviors;
    }

    protected function getRoles()
    {
        if (Yii::$app->user) {
            $this->roles = array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
        }

        return $this->roles;
    }
}
