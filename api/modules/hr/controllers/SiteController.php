<?php

namespace api\modules\hr\controllers;

define("API_HOST", env('API_HOST_INFO') . '/hr');

use Yii;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *   version="1.0",
 *   title="HR API",
 *   description="API For hr",
 *   @OA\Contact(
 *     name="Mohammad Aljaouni",
 *     email="dev.jaouni@gmail.com",
 *   ),
 * ),
 * @OA\Server(
 *   url=API_HOST,
 *   description="dev server",
 * )
 *
 * @OA\PathItem(
 *   path="/",
 * )
 *
 */
class SiteController extends \api\controllers\SiteController
{
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return array_merge(parent::actions(),
            [
                'api-json' => [
                    'class' => 'genxoft\swagger\JsonAction',
                    // Тhe list of directories that contains the swagger annotations.
                    'dirs' => [
                        Yii::getAlias('@api/modules/hr/controllers'),
                        Yii::getAlias('@api/modules/hr/models'),
                    ],
                ],
            ]
        );
    }

    /**
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(['/hr/site/docs']);
    }
}