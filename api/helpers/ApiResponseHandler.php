<?php

namespace api\helpers;

use Yii;
use Codeception\Util\HttpCode;

class ApiResponseHandler
{
    public static $responseMessageArray = [
        HttpCode::OK => "Request Successful",
        HttpCode::BAD_REQUEST => "Request Failed",
        HttpCode::UNAUTHORIZED => "Unauthenticated",
        HttpCode::UNPROCESSABLE_ENTITY => "Validation Error",
        HttpCode::NOT_FOUND => "Record does not exists.",
        HttpCode::INTERNAL_SERVER_ERROR => "Internal Server Error",
    ];

    /**
     * @param $errors array
     * @return array
     */
    public static function handleValidationErrors($errors)
    {
        $errors_list = null;

        if ($errors) {
            foreach ($errors as $key => $error) {
                if (!is_array($error)) {
                    $error = [$error];
                }

                $errors_list[] = [
                    'field' => $key,
                    'errors' => $error[0],
                ];
            }
        }

        return $errors_list;
    }

    public static function makeResponse($httpCode, $msg = null, $data = null, $errors = null, $exception = null)
    {
        if (!$msg) {
            $msg = 'An error occurred while processing your request.';

            if (isset(self::$responseMessageArray[$httpCode])) {
                $msg = self::$responseMessageArray[$httpCode];
            }
        }

        $response = array();
        $response['status'] = $httpCode;
        $response['message'] = $msg;
        $response['data'] = $data;
        $response['errors'] = self::handleValidationErrors($errors);
        $response['exception'] = $exception;

        return $response;
    }

    public static function makeSuccessResponse($data = null, $msg = null)
    {

        return [
            "status" => HttpCode::OK,
            "message" => $msg ? $msg : self::$responseMessageArray[HttpCode::OK],
            "data" => $data,
            "errors" => null,
            "exception" => null,
        ];
    }

    public static function makeErrorFailedResponse($exception, $errors = null)
    {
        $exception = $exception->getMessage();

        if (YII_ENV_PROD) {
            $exception = Yii::t('app', 'Something went wrong');
        }

        return [
            "status" => HttpCode::BAD_REQUEST,
            "message" => self::$responseMessageArray[HttpCode::BAD_REQUEST],
            "data" => null,
            "errors" => self::handleValidationErrors($errors),
            "exception" => $exception,
        ];
    }

    public static function makeErrorNotFoundResponse($msg = null, $errors = null)
    {
        return [
            "status" => HttpCode::NOT_FOUND,
            "message" => $msg ? $msg : self::$responseMessageArray[HttpCode::NOT_FOUND],
            "data" => null,
            "errors" => self::handleValidationErrors($errors),
            "exception" => null,
        ];
    }

    public static function makeErrorAuthResponse($msg = null, $errors = null)
    {
        return [
            "status" => HttpCode::UNAUTHORIZED,
            "message" => $msg ? $msg : self::$responseMessageArray[HttpCode::UNAUTHORIZED],
            "data" => null,
            "errors" => self::handleValidationErrors($errors),
            "exception" => null,
        ];
    }

    public static function makeErrorValidationResponse($errors = null, $msg = null, $data = null, $status_code = HttpCode::UNPROCESSABLE_ENTITY)
    {
        return [
            "status" => $status_code,
            "message" => $msg ? $msg : self::$responseMessageArray[HttpCode::UNPROCESSABLE_ENTITY],
            "data" => $data,
            "errors" => self::handleValidationErrors($errors),
            "exception" => null,
        ];
    }
}