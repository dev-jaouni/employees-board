<?php

namespace api\modules\employee\controllers;

use Yii;
use api\helpers\ApiResponseHandler;
use api\components\RestBaseController;
use api\modules\employee\resources\User;
use api\modules\employee\resources\ContactInfo;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class UserController extends RestBaseController
{
    /**
     * @OA\Patch(
     *   path                   = "/user/update-contact/",
     *   summary                = "Update User Contact Information",
     *   tags                   = {"User"},
     *
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\RequestBody(ref    = "#/components/requestBodies/UpdateContact"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "User Contact Information Updated",
     *   ),
     *     security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionUpdateContact()
    {
        try {
            if (!in_array(User::ROLE_EMPLOYEE, $this->getRoles())) {
                return ApiResponseHandler::makeErrorAuthResponse("Unauthorized");
            }

            $request_params = Yii::$app->request->post();
            $user = ContactInfo::findOneWithProfile(Yii::$app->user->id);
            if (!$user->load($request_params, '') || !$user->save() || !$user->userProfile->load($request_params, '') || !$user->userProfile->save()) {
                return ApiResponseHandler::makeErrorValidationResponse($user->errors);
            }

            return ApiResponseHandler::makeSuccessResponse($user);

        } catch (\Exception $e) {
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }
}
