<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FirePropertyDamageController;
use App\Http\Resources\FirePropertyDamageCollection;
use Illuminate\Http\Request;

class FirePropertyDamageApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $fpdamages = (new FirePropertyDamageController)->index($request, 'api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $fpdamages = $fpdamages->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }


        if ($request->has('meta_fire_category_id')) {
            $fpdamages = $fpdamages->where('meta_fire_category_id', $request->meta_fire_category_id);
        }
        if ($request->has('meta_unit_id')) {
            $fpdamages = $fpdamages->where('meta_unit_id', $request->meta_unit_id);
        }
        if ($request->has('meta_property_damage_id')) {
            $fpdamages = $fpdamages->where('meta_property_damage_id', $request->meta_property_damage_id);
        }
        if ($request->has('meta_incident_status_id')) {
            $fpdamages = $fpdamages->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $fpdamages = $fpdamages->where('initiated_by', $request->initiated_by);
        }

        if ($fpdamages) {
            return FirePropertyDamageCollection::collection($fpdamages->paginate($limit));
            // return ApiResponseController::successWithJustData(FirePropertyDamageCollection::collection($fpdamages->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching fire property damages');
        }
    }

    public function store(Request $request)
    {
        $response = (new FirePropertyDamageController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing fire proerpty damages.', 400);
        }

    }
    public function update(Request $request, $fpdamage_id)
    {
        $response = (new FirePropertyDamageController)->update($request, $fpdamage_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating fire proerpty damages.', 400);
        }
    }
    public function show(Request $request, $fpdamage_id)
    {
        $fpdamage = (new FirePropertyDamageController)->show($fpdamage_id, 'api');
        if ($fpdamage) {
            return ApiResponseController::successWithJustData(new FirePropertyDamageCollection($fpdamage));
        } else {
            return ApiResponseController::error('Problem while fetching fire proerpty damages.', 400);
        }
    }

    public function assign(Request $request, $fpdamage_id)
    {
        $response = (new FirePropertyDamageController)->assign($request, $fpdamage_id, "api");
        if ($response) {
            if (is_array($response) && $response[0] === 'success') {
                return ApiResponseController::successWithJustData(new FirePropertyDamageCollection($response[1]));
            } else {
                return $response;
            }
        } else {
            return ApiResponseController::error('Problem while assiging fire property damage.', 400);
        }

    }

    public function destroy($fpdamage_id)
    {
        $response = (new FirePropertyDamageController)->destroy($fpdamage_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting fire property damage.', 400);
        }
    }
}