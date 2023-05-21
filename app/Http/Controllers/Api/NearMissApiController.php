<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NearMissController;
use App\Http\Resources\NearMissCollection;
use Illuminate\Http\Request;

class NearMissApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $near_misss = (new NearMissController)->index($request, 'api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $near_misss = $near_misss->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_incident_status_id')) {
            $near_misss = $near_misss->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $near_misss = $near_misss->where('initiated_by', $request->initiated_by);
        }

        if ($near_misss) {
            return NearMissCollection::collection($near_misss->paginate($limit));
            // return ApiResponseController::successWithJustData(NearMissCollection::collection($near_misss->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching near misses');
        }
    }

    public function store(Request $request)
    {
        $response = (new NearMissController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing near misses.', 400);
        }

    }
    public function update(Request $request, $near_miss_id)
    {
        $response = (new NearMissController)->update($request, $near_miss_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating near misses.', 400);
        }
    }
    public function show(Request $request, $near_miss_id)
    {
        $near_miss = (new NearMissController)->show($near_miss_id, 'api');
        if ($near_miss) {
            return ApiResponseController::successWithJustData(new NearMissCollection($near_miss));
        } else {
            return ApiResponseController::error('Problem while fetching near misses.', 400);
        }
    }

    public function assign(Request $request, $near_miss_id)
    {
        $response = (new NearMissController)->assign($request, $near_miss_id, "api");
        if ($response) {
            if (is_array($response) && $response[0] === 'success') {
                return ApiResponseController::successWithJustData(new NearMissCollection($response[1]));
            } else {
                return $response;
            }
        } else {
            return ApiResponseController::error('Problem while assiging Near Miss', 400);
        }

    }

    public function destroy($near_miss_id)
    {
        $response = (new NearMissController)->destroy($near_miss_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting Near Miss', 400);
        }
    }
}