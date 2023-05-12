<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HazardController;
use App\Http\Resources\HazardCollection;
use Illuminate\Http\Request;

class HazardApiController extends Controller
{
    public function index(Request $requst)
    {

    }

    public function store(Request $request)
    {
        return $response = (new HazardController)->store($request, 'api');
    }

    public function show(Request $request, $hazard_id)
    {
        $hazard = (new HazardController)->show($hazard_id, 'api');
        if ($hazard) {
            return ApiResponseController::successWithJustData(new HazardCollection($hazard));
        } else {
            return ApiResponseController::error('Problem while fetching hazards.', 400);
        }
    }
}