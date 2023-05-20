<?php

namespace App\Http\Controllers\Api;

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
}