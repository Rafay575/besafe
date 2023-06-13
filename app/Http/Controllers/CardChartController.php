<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Traits\Charts\ChartHelperMethods;
use App\Traits\Charts\IEAuditCluase;
use App\Traits\Charts\IncidentChart;
use App\Traits\Charts\PtwChart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CardChartController extends Controller
{
    use ChartHelperMethods, IncidentChart, PtwChart, IEAuditCluase;
    public function index(Request $request, $channel = "web")
    {
        if ($request->has('data_by')) {
            if ($request->data_by == "daily") {
                $data = $this->dailyCardChart($request);
            }
            if ($request->data_by == "monthly") {
                $data = $this->monthlyCardChart($request);
            }
            if ($request->data_by == "yearly") {
                $data = $this->yearlyCardChartOfTenYears($request);
            }
        }
        if ($request->has('group_by') && $request->group_by != "") {
            $data = $this->customGroupByCardChart($request);
        }

        if ($channel === "api") {
            return ApiResponseController::successWithJustData($data);
        }

        return $data;
    }
    public function piChartAllTimeLines($requests, $channel = "web")
    {
        $data = [];
        foreach ($requests as $request) {
            $keyName = $request->chart_of;
            if ($request->has('incident') && $request->incident != "" && $request->chart_of == "incidents") {
                $keyName = $request->incident;
                if ($keyName == 'all') {
                    $keyName = "incident_all";
                }
            }
            // $keyName = $keyName . '_' . $request->data_by;
            $response = $this->index($request, 'web')[0];
            if (array_key_exists('data', $response)) {
                $value = $response['data'];
                $labels = $response['labels'];

            }
            // Prepare the data for the pie chart
            for ($i = 0; $i < count($labels); $i++) {
                $color = '#' . substr(md5(mt_rand()), 0, 6); // Generate a random color
                $legendFontColor = '#' . substr(md5(mt_rand()), 0, 6); // Generate a random legend font color

                if ($channel == 'api') {
                    $data[$keyName][$i] = [
                        'name' => $labels[$i],
                        'color' => $color,
                        'legendFontColor' => $legendFontColor,
                        'legendFontSize' => 15,
                        'population' => $value[$i]
                    ];
                } else {
                    $data[$keyName][$i] = [
                        'label' => $labels[$i],
                        'color' => $color,
                        'legendFontColor' => $legendFontColor,
                        'data' => $value[$i]
                    ];
                }
            }
        }
        if ($channel === "api") {
            return ApiResponseController::successWithJustData($data);
        }
    }
    private function createRequest($dataBy, $chart_of, $incident_name = "all")
    {
        $request = Request::create('/');
        $request->merge(['data_by' => $dataBy, 'chart_of' => $chart_of, 'incident' => $incident_name]); // Set the desired property
        return $request;
    }


    public function prepareForPiChart(Request $request, $channel = "web")
    {
        $requestsArray = [];
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

        if ($channel == "api") {
            return $this->piChartAllTimeLines($requestsArray, 'api');
        }
    }
    public function dailyCardChart($request)
    {
        $results = [];
        if ($request->has('chart_of') && $request->chart_of == 'incidents') {
            $results[] = $this::incidentCardChartData($request, 'day');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ptws') {
            $results[] = $this::ptwsCardChartData($request, 'day');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
            $results[] = $this::IEAuditCardChartData($request, 'day');
        }
        return $results;
    }
    public function monthlyCardChart($request)
    {
        $results = [];
        if ($request->has('chart_of') && $request->chart_of == 'incidents') {
            $results[] = $this::incidentCardChartData($request, 'month');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ptws') {
            $results[] = $this::ptwsCardChartData($request, 'month');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
            $results[] = $this::IEAuditCardChartData($request, 'month');
        }
        return $results;
    }

    public function yearlyCardChartOfTenYears($request)
    {
        $results = [];
        if ($request->has('chart_of') && $request->chart_of == 'incidents') {
            $results[] = $this::incidentCardChartData($request, 'year');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ptws') {
            $results[] = $this::ptwsCardChartData($request, 'year');
        }
        if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
            $results[] = $this::IEAuditCardChartData($request, 'year');
        }
        return $results;
    }

    public function customGroupByCardChart($request)
    {
        $results = [];
        if ($request->has('chart_of') && $request->chart_of == 'incidents') {
            $results[] = $this::incidentCardChartData($request, $request->group_by);
        }
        return $results;
    }

}