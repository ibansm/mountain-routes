<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success($data = [],$statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }

    public static function fail($data = [],$statusCode) 
    {
        return response()->json([
            'status' => 'fail',
            'data' => $data
        ], $statusCode);
    }

    public static function error($data = [],$statusCode)
    {
        return response()->json([
            'status' => 'error',
            'message' => $data
        ], $statusCode);
    }
}


?>