<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\IncidentController;
use App\Http\Resources\IncidentCollection;
use Illuminate\Http\Request;

class IncidentApiController extends Controller
{
    public function index(Request $request)
    {
        $incidents = (new IncidentController)->index($request, "api");
        if ($incidents) {
            return IncidentCollection::collection($incidents);
            // return ApiResponseController::successWithJustData(IncidentCollection::collection($incidents));
        } else {
            return ApiResponseController::error('Problme while fetching incidents');
        }
    }
}