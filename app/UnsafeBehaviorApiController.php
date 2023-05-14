<?php

namespace App;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UnsafeBehaviorController;
use App\Http\Resources\UnsafeBehaviorCollection;
use Illuminate\Http\Request;

class UnsafeBehaviorApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $unsafe_behavior = (new UnsafeBehaviorController)->index('api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $unsafe_behavior = $unsafe_behavior->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_department_id')) {
            $unsafe_behavior = $unsafe_behavior->where('meta_department_id', $request->meta_department_id);
        }
        if ($request->has('meta_line_id')) {
            $unsafe_behavior = $unsafe_behavior->where('meta_line_id', $request->meta_line_id);
        }
        if ($request->has('meta_unit_id')) {
            $unsafe_behavior = $unsafe_behavior->where('meta_unit_id', $request->meta_unit_id);
        }
        if ($request->has('meta_incident_status_id')) {
            $unsafe_behavior = $unsafe_behavior->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $unsafe_behavior = $unsafe_behavior->where('initiated_by', $request->initiated_by);
        }

        if ($unsafe_behavior) {
            return ApiResponseController::successWithJustData(UnsafeBehaviorCollection::collection($unsafe_behavior->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching unsafe behaviors');
        }
    }


    public function store(Request $request)
    {
        $response = (new UnsafeBehaviorController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing unsafe behavior.', 400);
        }

    }

    public function update(Request $request, $unsafe_behavior_id)
    {
        $response = (new UnsafeBehaviorController)->update($request, $unsafe_behavior_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating unsafe behavior.', 400);
        }
    }

    public function show(Request $request, $unsafe_behavior_id)
    {
        $unsafe_behavior = (new UnsafeBehaviorController)->show($unsafe_behavior_id, 'api');
        if ($unsafe_behavior) {
            return ApiResponseController::successWithJustData(new UnsafeBehaviorCollection($unsafe_behavior));
        } else {
            return ApiResponseController::error('Problem while fetching unsafe behavior.', 400);
        }
    }

    public function assign(Request $request, $unsafe_behavior_id)
    {
        $response = (new UnsafeBehaviorController)->assign($request, $unsafe_behavior_id, "api");
        if ($response) {
            if (is_array($response) && $response[0] === 'success') {
                return ApiResponseController::successWithJustData(new UnsafeBehaviorCollection($response[1]));
            } else {
                return $response;
            }
        } else {
            return ApiResponseController::error('Problem while assiging unsafe behavior.', 400);
        }

    }

    public function destroy($unsafe_behavior_id)
    {
        $response = (new UnsafeBehaviorController)->destroy($unsafe_behavior_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting unsafe behavior.', 400);
        }
    }
}