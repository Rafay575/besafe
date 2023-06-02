<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function index(Request $request)
    {
        $response = (new NotificationController)->index($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while fetching notifications.', 400);
        }
    }

    public function activitySeen(Request $request)
    {
        $response = (new NotificationController)->activitySeen($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while fetching notifications.', 400);
        }
    }
}