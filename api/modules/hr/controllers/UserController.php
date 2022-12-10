<?php

namespace api\modules\hr\controllers;

use api\modules\hr\resources\Employee;
use api\modules\hr\resources\RegisterEmployee;
use common\models\UserProfile;
use Yii;
use api\components\BaseModel;
use api\helpers\ApiResponseHandler;
use api\components\RestBaseController;
use api\modules\employee\resources\User;
use api\modules\hr\models\search\EmployeeSearch;

/**
 * @author Mohammad Aljaouni <dev.jaouni@gmail.com>
 */
class UserController extends RestBaseController
{
    /**
     * @OA\Get(
     *   path                   = "/user/employees/",
     *   summary                = "Get All Employees",
     *   tags                   = {"User"},
     *
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/page_query_optional"),
     *   @OA\Parameter(ref      = "#/components/parameters/page_size_query_optional"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "Employees List",
     *   ),
     *
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionEmployees()
    {
        try {
            if (!in_array(User::ROLE_HR_MANAGER, $this->getRoles())) {
                return ApiResponseHandler::makeErrorAuthResponse("Unauthorized");
            }

            $employees = new EmployeeSearch();
            $employees_data_provider = $employees->search([]);

            $pages_count = ceil($employees_data_provider->totalCount / $employees_data_provider->pagination->pageSize);

            return ApiResponseHandler::makeSuccessResponse([[BaseModel::PAGES_COUNT => $pages_count, BaseModel::LIST_EMPLOYEES => $employees_data_provider]]);

        } catch (\Exception $e) {
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }


    /**
     * @OA\Post(
     *   path                   = "/user/add-employee/",
     *   summary                = "Add New Employee",
     *   tags                   = {"User"},
     *
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\RequestBody(ref    = "#/components/requestBodies/AddEmployee"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "Employee has been successfully created",
     *   ),
     *
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionAddEmployee()
    {
        if (!in_array(User::ROLE_HR_MANAGER, $this->getRoles())) {
            return ApiResponseHandler::makeErrorAuthResponse("Unauthorized");
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $request_params = $this->requestParams;
            $model = new RegisterEmployee();
            if (!$model->load($request_params, '')) {
                return ApiResponseHandler::makeErrorNotFoundResponse(\Yii::t('error', 'process failed, something went wrong'));
            }
            $model->status = RegisterEmployee::STATUS_ACTIVE;
            $model->setPassword($model->password);

            if (!$model->save() || $model->afterSignup($request_params)) {
                $transaction->rollBack();
                return ApiResponseHandler::makeErrorValidationResponse($model->errors);
            }

            $transaction->commit();
            return ApiResponseHandler::makeSuccessResponse([BaseModel::COMPONENT_NAME => BaseModel::USER_DATA, 'data' => [$model]]);

        } catch (\Exception $e) {
            $transaction->rollBack();
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }

    /**
     * @OA\Patch(
     *   path                   = "/user/deactivate-employee/{employee_id}",
     *   summary                = "Deactivate Employee",
     *   tags                   = {"User"},
     *
     *   @OA\Parameter(ref      = "#/components/parameters/lang"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_name_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_type_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/app_version_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/device_id_header_required"),
     *   @OA\Parameter(ref      = "#/components/parameters/employee_id_path"),
     *
     *   @OA\Response(
     *     response             = 200,
     *     description          = "Employee has been successfully Deactivated",
     *   ),
     *
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionDeactivateEmployee()
    {
        if (!in_array(User::ROLE_HR_MANAGER, $this->getRoles())) {
            return ApiResponseHandler::makeErrorAuthResponse("Unauthorized");
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $request_params = $this->requestParams;

            $employee = Employee::findOne(['id' => $request_params['id']]);

            if (!$employee || !in_array(Employee::ROLE_EMPLOYEE, $employee->roles)) {
                return ApiResponseHandler::makeErrorNotFoundResponse(\Yii::t('error', 'Employee not found'));
            }

            $employee->status = Employee::STATUS_NOT_ACTIVE;

            if (!$employee->save()) {
                $transaction->rollBack();
                return ApiResponseHandler::makeErrorValidationResponse($employee->errors);
            }

            $transaction->commit();
            return ApiResponseHandler::makeSuccessResponse([BaseModel::COMPONENT_NAME => BaseModel::USER_DATA, 'data' => [$employee]]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            return ApiResponseHandler::makeErrorFailedResponse($e);
        }
    }
}
