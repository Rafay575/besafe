<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InjuryController;
use App\Http\Resources\InjuryCollection;
use Illuminate\Http\Request;

class InjuryApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $injuries = (new InjuryController)->index($request, 'api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $injuries = $injuries->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_injury_category_id')) {
            $injuries = $injuries->where('meta_injury_category_id', $request->meta_injury_category_id);
        }
        if ($request->has('meta_incident_category_id')) {
            $injuries = $injuries->where('meta_incident_category_id', $request->meta_incident_category_id);
        }

        if ($request->has('meta_incident_status_id')) {
            $injuries = $injuries->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $injuries = $injuries->where('initiated_by', $request->initiated_by);
        }

        if ($injuries) {
            return InjuryCollection::collection($injuries->paginate($limit));
            // return ApiResponseController::successWithJustData(InjuryCollection::collection($injuries->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching injuries');
        }
    }

    public function store(Request $request)
    {
        $response = (new InjuryController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing injuries.', 400);
        }

    }
    public function update(Request $request, $injury_id)
    {
        $response = (new InjuryController)->update($request, $injury_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating injuries.', 400);
        }
    }
    public function show(Request $request, $injury_id)
    {
        $injury = (new InjuryController)->show($injury_id, 'api');
        if ($injury) {
            return ApiResponseController::successWithJustData(new InjuryCollection($injury));
        } else {
            return ApiResponseController::error('Problem while fetching injuries.', 400);
        }
    }

    public function assign(Request $request, $injury_id)
    {
        $response = (new InjuryController)->assign($request, $injury_id, "api");
        if ($response) {
            if (is_array($response) && $response[0] === 'success') {
                return ApiResponseController::successWithJustData(new InjuryCollection($response[1]));
            } else {
                return $response;
            }
        } else {
            return ApiResponseController::error('Problem while assiging injury.', 400);
        }

    }

    public function destroy($injury_id)
    {
        $response = (new InjuryController)->destroy($injury_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting injury.', 400);
        }
    }
}