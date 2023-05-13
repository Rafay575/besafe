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
        $response = (new HazardController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing hazards.', 400);
        }

    }
    public function update(Request $request, $hazard_id)
    {
        $response = (new HazardController)->update($request, $hazard_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating hazards.', 400);
        }
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

    public function assign(Request $request, $hazard_id)
    {
        return (new HazardController)->assign($request, $hazard_id, "api");
    }

    public function destroy($hazard_id)
    {
        $response = (new HazardController)->destroy($hazard_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting hazard.', 400);
        }
    }
}