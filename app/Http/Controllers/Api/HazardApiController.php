<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HazardController;
use App\Http\Resources\HazardCollection;
use Illuminate\Http\Request;

class HazardApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $hazards = (new HazardController)->index('api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $hazards = $hazards->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_department_id')) {
            $hazards = $hazards->where('meta_department_id', $request->meta_department_id);
        }
        if ($request->has('meta_line_id')) {
            $hazards = $hazards->where('meta_line_id', $request->meta_line_id);
        }
        if ($request->has('meta_unit_id')) {
            $hazards = $hazards->where('meta_unit_id', $request->meta_unit_id);
        }
        if ($request->has('meta_incident_status_id')) {
            $hazards = $hazards->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $hazards = $hazards->where('initiated_by', $request->initiated_by);
        }

        if ($hazards) {
            return HazardCollection::collection($hazards->paginate($limit));
            // return ApiResponseController::successWithJustData(HazardCollection::collection($hazards->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching hazards');
        }
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
        $response = (new HazardController)->assign($request, $hazard_id, "api");
        if ($response) {
            if (is_array($response) && $response[0] === 'success') {
                return ApiResponseController::successWithJustData(new HazardCollection($response[1]));
            } else {
                return $response;
            }
        } else {
            return ApiResponseController::error('Problem while assiging hazard.', 400);
        }

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