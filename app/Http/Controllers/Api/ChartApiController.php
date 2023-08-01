<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BarChartController;
use App\Http\Controllers\CardChartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LineChartController;
use Illuminate\Http\Request;

class ChartApiController extends Controller
{
    public function line_chart(Request $request)
    {
        return (new LineChartController)->index($request, 'api');
    }
    public function card_chart(Request $request)
    {
        return (new CardChartController)->index($request, 'api');
    }

    public function indexAllTimeLines(Request $request)
    {
        if ($request->has('data_by')) {
            return (new LineChartController)->prepareForLineChart($request, 'api');
        } else {
            return ApiResponseController::error('Please provide data_by');
        }

    }
    public function piChartAllTimeLines(Request $request)
    {
        if ($request->has('data_by')) {
            return (new CardChartController)->prepareForPiChart($request, 'api');
        } else {
            return ApiResponseController::error('Please provide data_by');
        }
    }
    public function barCharts(Request $request)
    {
        return (new BarChartController)->prepareForBarChart($request, 'api');

    }


}