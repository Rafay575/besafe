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

    public function indexAllTimeLines()
    {
        $requests = [
            $this->createRequest('monthly', 'incidents', 'all'),
            $this->createRequest('daily', 'incidents', 'all'),
            $this->createRequest('yearly', 'incidents', 'all'),

            $this->createRequest('monthly', 'ptws'),
            $this->createRequest('daily', 'ptws'),
            $this->createRequest('yearly', 'ptws'),

            $this->createRequest('monthly', 'ie_audit'),
            $this->createRequest('daily', 'ie_audit'),
            $this->createRequest('yearly', 'ie_audit'),

        ];

        return (new LineChartController)->indexAllTimes($requests, 'api');

    }

    private function createRequest($dataBy, $chart_of, $incident_name = "all")
    {
        $request = Request::create('/');
        $request->merge(['data_by' => $dataBy, 'chart_of' => $chart_of, 'incident' => $incident_name]); // Set the desired property
        return $request;
    }
}