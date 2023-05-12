<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormValidatitionDispatcherController extends Controller
{
    /** */
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