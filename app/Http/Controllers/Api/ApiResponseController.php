<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiResponseController extends Controller
{
    public static function error($message, $http_code = 401)
    {
        return response()->json([
            'error' => ['message' => $message],
        ], $http_code);
    }

    public static function errorWithData($message, $data, $http_code = 401)
    {
        return response()->json([
            'error' => ['message' => $message],
            'data' => $data,
        ], $http_code);
    }

    public static function success($message)
    {
        return response()->json([
            'success' => ['message' => $message],
        ], 200);

    }

    public static function successWithData($message, $data)
    {
        return response()->json([
            'success' => ['message' => $message],
            'data' => $data,
        ], 200);
    }

    public static function successWithJustData($data)
    {
        return response()->json([
            'data' => $data,
        ], 200);
    }
}