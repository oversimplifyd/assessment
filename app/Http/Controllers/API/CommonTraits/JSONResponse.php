<?php

namespace App\Http\Controllers\API\CommonTraits;

use App\Exceptions\AppError;

trait JSONResponse
{
    public function success($data, $code = 200, $meta = [])
    {
        return response()->json([
            "data" => $data,
            "meta" => $meta
        ], $code);
    }

    public function error(AppError $error, $message, $code = 404)
    {
        return response()->json([
            "status" => false,
            "errors" =>  $error->getErrorDetails($message)
        ], $code);
    }
}
