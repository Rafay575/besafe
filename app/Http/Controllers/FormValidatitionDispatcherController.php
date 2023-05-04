<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormValidatitionDispatcherController extends Controller
{
    /**
     * Summary of Response
     * @param mixed $validator
     * @param mixed $channel
     * @return \Illuminate\Http\JsonResponse|array|bool
     */
    public static function Response($validator, $channel)
    {
        if ($validator->fails()) {
            if ($channel == 'api') {
                return response()->json([
                    'errors' => [$validator->errors()],
                ], 422);
            } else {
                $error = $validator->errors()->first();
                return ['error', $error];
            }
        } else {
            return false;
        }
    }
}