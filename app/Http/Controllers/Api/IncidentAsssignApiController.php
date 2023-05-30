<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IncidentAssignController;
use Illuminate\Http\Request;

class IncidentAsssignApiController extends Controller
{
    public function update(Request $request, $incident_assign_id)
    {
        $response = (new IncidentAssignController)->update($request, $incident_assign_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Could not update assigned users');
        }
    }

    public function storeByIncidentName(Request $request)
    {
        $response = (new IncidentAssignController)->storeByIncidentName($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Could not update assigned users');
        }
    }

    public function rejectIncidentByName(Request $request)
    {
        $response = (new IncidentAssignController)->rejectIncidentByName($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Could not Reject the incident');
        }
    }
}