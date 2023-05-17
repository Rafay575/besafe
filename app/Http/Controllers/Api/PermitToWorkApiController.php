<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PermitToWorkController;
use App\Http\Resources\PermitToWorkCollection;
use Illuminate\Http\Request;

class PermitToWorkApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $ptws = (new PermitToWorkController)->index('api');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $ptws = $ptws->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_ptw_type_id')) {
            $ptws = $ptws->where('meta_ptw_type_id', $request->meta_ptw_type_id);
        }
        if ($request->has('meta_ptw_item_id')) {
            $ptws = $ptws->where('meta_ptw_item_id', $request->meta_ptw_item_id);
        }

        if ($request->has('initiated_by')) {
            $ptws = $ptws->where('initiated_by', $request->initiated_by);
        }

        if ($ptws) {
            return ApiResponseController::successWithJustData(PermitToWorkCollection::collection($ptws->paginate($limit)));
        } else {
            return ApiResponseController::error('Problme while fetching PTWs');
        }
    }

    public function store(Request $request)
    {
        $response = (new PermitToWorkController)->store($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while storing PTW.', 400);
        }

    }
    public function update(Request $request, $ptw_id)
    {
        $response = (new PermitToWorkController)->update($request, $ptw_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while updating PTW.', 400);
        }
    }
    public function show(Request $request, $ptw_id)
    {
        $ptw = (new PermitToWorkController)->show($ptw_id, 'api');
        if ($ptw) {
            return ApiResponseController::successWithJustData(new PermitToWorkCollection($ptw));
        } else {
            return ApiResponseController::error('Problem while fetching PTW.', 400);
        }
    }



    public function destroy($ptw_id)
    {
        $response = (new PermitToWorkController)->destroy($ptw_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting PTW.', 400);
        }
    }
}