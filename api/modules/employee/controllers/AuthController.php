<?php

namespace api\modules\employee\controllers;

use Yii;
use OpenApi\Annotations as OA;
use Codeception\Util\HttpCode;
use api\components\BaseModel;
use api\modules\employee\resources\User;
use api\helpers\ApiResponseHandler;
use api\components\RestBaseController;
use api\modules\employee\resources\UserDevice;

class AuthController extends RestBaseController
{
    /**
     * @OA\Post(
     *   path                   = "/auth/login",
     *   summary                = "User Login",
     *   tags                   = {"Authentication"},
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\RequestBody(ref    = "#/components/requestBodies/LoginUser"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "User Login Process",
     *   ),
     * )
     */

    public function actionLogin()
    {
        try {
            $model = new User();
            $model->device_id = Yii::$app->request->headers['device-id'];

            if ($model->load($this->requestParams, '') && $user = $model->login()) {
                if ($user->status == User::STATUS_NOT_ACTIVE) {
                    return ApiResponseHandler::makeErrorValidationResponse($model->errors, "Unauthorized, Your account Inactive", null, HttpCode::FORBIDDEN);
                }

                return ApiResponseHandler::makeSuccessResponse([BaseModel::COMPONENT_NAME => BaseModel::USER_DATA, 'data' => [$user]]);
            }

            return ApiResponseHandler::makeErrorValidationResponse($model->errors, "Unauthenticated", null, HttpCode::UNAUTHORIZED);

        } catch (\Exception $e) {
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }

    /**
     * @OA\Post(
     *   path                   = "/auth/refresh-token",
     *   summary                = "User Refresh Token",
     *   tags                   = {"Authentication"},
     *
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/expire_access_token_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/refresh_token_header_required"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "Refresh Token",
     *   ),
     * )
     */
    public function actionRefreshToken()
    {
        try {
            $request = Yii::$app->request->headers;

            if (!isset($request['access-token']) || !isset($request['refresh-token'])) {
                return ApiResponseHandler::makeErrorNotFoundResponse(Yii::t('app', 'process failed, something went wrong'));
            }

            $access_token = $request['access-token'];
            $refresh_token = $request['refresh-token'];

            /* @var $user_device UserDevice */
            $user_device = UserDevice::checkUserTokens($access_token, $refresh_token);
            if (!$user_device) {
                return ApiResponseHandler::makeResponse('402', Yii::t('app', 'invalid user'));
            }

            $user = $user_device->generateTokens();

            return ApiResponseHandler::makeSuccessResponse(['data' => [$user]]);

        } catch (\Exception $e) {
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }
}
