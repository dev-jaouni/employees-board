<?php

namespace api\modules\hr\models\definitions;

use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *   parameter      = "lang",
 *   in             = "header",
 *   name           = "lang",
 *   description    = "Language of returned data",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *     enum         = {"en", "ar"}
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "app_name_header_required",
 *   in             = "header",
 *   name           = "x-app-name",
 *   description    = "Application Name (motory)",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *     enum         = {"employees-board"}
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "device_type_header_required",
 *   in             = "header",
 *   name           = "x-device-type",
 *   description    = "Device Type",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *     enum         = {"android", "ios"}
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "device_id_header_required",
 *   in             = "header",
 *   name           = "device-id",
 *   description    = "Device ID",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "expire_access_token_header_required",
 *   in             = "header",
 *   name           = "access-token",
 *   description    = "Expire Access Token",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "refresh_token_header_required",
 *   in             = "header",
 *   name           = "refresh-token",
 *   description    = "Refresh Token",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "page_query_optional",
 *   in             = "query",
 *   name           = "page",
 *   description    = "Returns a specific page - Example {1, 2, 3}",
 *   required       = false,
 *   @OA\Schema(
 *     type         = "integer",
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "page_size_query_optional",
 *   in             = "query",
 *   name           = "per-page",
 *   description    = "Number of items to return - Example {5, 8, 10}",
 *   required       = false,
 *   @OA\Schema(
 *     type         = "integer",
 *   ),
 * )
 *
 * @OA\Parameter(
 *   parameter      = "app_version_header_required",
 *   in             = "header",
 *   name           = "x-app-version",
 *   description    = "Application Version - Example {1.0(android), 1.0(ios)}",
 *   required       = true,
 *   @OA\Schema(
 *     type         = "string",
 *     enum         = {"1.0"}
 *   ),
 * )
 */
class Common
{
    // dummy class for Swagger definitions
}
