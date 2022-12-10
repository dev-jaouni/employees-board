<?php

namespace api\modules\hr\models\definitions;

use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *   request                = "LoginUser",
 *   required               = true,
 *   description            = "Request Params",
 *   @OA\JsonContent(ref    = "#/components/schemas/LoginUser"),
 * )
 *
 * @OA\Schema(
 *   schema         = "LoginUser",
 *
 *   @OA\Property(
 *     property     = "username",
 *     description  = "Username",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "password",
 *     description  = "Password",
 *     type         = "string",
 *   ),
 *
 *   required = {
 *     "username",
 *     "password",
 *   },
 * )
 */

/**
 * @OA\RequestBody(
 *   request                = "UpdateContact",
 *   required               = true,
 *   description            = "Request Params",
 *   @OA\JsonContent(ref    = "#/components/schemas/UpdateContact"),
 * )
 *
 * @OA\Schema(
 *   schema         = "UpdateContact",
 *
 *   @OA\Property(
 *     property     = "first_name",
 *     description  = "First Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "middle_name",
 *     description  = "Middle Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "last_name",
 *     description  = "Last Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "email",
 *     description  = "User Email",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "phone",
 *     description  = "Phone",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "job_title",
 *     description  = "Job Title",
 *     type         = "string",
 *   ),
 *
 * )
 *
 */

/**
 * @OA\RequestBody(
 *   request                = "AddEmployee",
 *   required               = true,
 *   description            = "Request Params",
 *   @OA\JsonContent(ref    = "#/components/schemas/AddEmployee"),
 * )
 *
 * @OA\Schema(
 *   schema         = "AddEmployee",
 *
 *   @OA\Property(
 *     property     = "username",
 *     description  = "Username",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "phone",
 *     description  = "User phone",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "email",
 *     description  = "User email",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "password",
 *     description  = "user Password",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "first_name",
 *     description  = "First Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "middle_name",
 *     description  = "Middle Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "last_name",
 *     description  = "Last Name",
 *     type         = "string",
 *   ),
 *
 *   @OA\Property(
 *     property     = "gender",
 *     description  = "Gender",
 *     type         = "integer",
 *     enum         = {"1: Male", "2: Female"}
 *   ),
 *
 *   @OA\Property(
 *     property     = "job_title",
 *     description  = "Job Title",
 *     type         = "string",
 *   ),
 *
 *   required = {
 *     "name",
 *     "phone",
 *     "password",
 *   },
 * )
 */

/**
 *
 * @OA\Parameter(
 *   parameter      = "employee_id_path",
 *   in             = "path",
 *   name           = "employee_id",
 *   description    = "Employee Id",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "integer",
 *   ),
 * )
 */

/**
 * Class User
 * @package api\modules\hr\models\definitions
 */
class User
{
    // dummy class for Swagger definitions
}
