<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;

class ReportApiController extends Controller
{
    public function index(Request $request)
    {
        $response = (new ReportController)->index($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Could not fetch report');
        }
    }
    public function createReport(Request $request)
    {
        $response = (new ReportController)->createReport($request, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Could not create report');
        }
    }


    public function destroy($report_id)
    {
        $response = (new ReportController)->destroy($report_id, 'api');
        if ($response) {
            return $response;
        } else {
            return ApiResponseController::error('Problem while deleting report.', 400);
        }
    }
}