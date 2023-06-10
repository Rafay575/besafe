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

    public function indexAllTimeLines(Request $request)
    {
        $requestsArray = [];
        if ($request->has('data_by')) {
            if ($request->data_by === 'daily') {
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'unsafe_behavior');
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'all');
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'fire_property_damage');
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'hazard');
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'injury');
                $requestsArray[] = $this->createRequest('daily', 'incidents', 'near_miss');
                $requestsArray[] = $this->createRequest('daily', 'ptws');
                $requestsArray[] = $this->createRequest('daily', 'ie_audit');
            }

            if ($request->data_by === 'monthly') {
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'all');
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'hazard');
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'unsafe_behavior');
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'fire_property_damage');
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'near_miss');
                $requestsArray[] = $this->createRequest('monthly', 'ie_audit');
                $requestsArray[] = $this->createRequest('monthly', 'incidents', 'injury');
                $requestsArray[] = $this->createRequest('monthly', 'ptws');
            }

            if ($request->data_by == 'yearly') {
                $requestsArray[] = $this->createRequest('yearly', 'ptws');
                $requestsArray[] = $this->createRequest('yearly', 'ie_audit');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'hazard');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'all');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'unsafe_behavior');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'fire_property_damage');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'injury');
                $requestsArray[] = $this->createRequest('yearly', 'incidents', 'near_miss');
            }
        } else {
            return ApiResponseController::error('Please provide data_by');
        }



        return (new LineChartController)->indexAllTimes($requestsArray, 'api');

    }

    private function createRequest($dataBy, $chart_of, $incident_name = "all")
    {
        $request = Request::create('/');
        $request->merge(['data_by' => $dataBy, 'chart_of' => $chart_of, 'incident' => $incident_name]); // Set the desired property
        return $request;
    }
}