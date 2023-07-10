<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Traits\Charts\ChartHelperMethods;
use App\Traits\Charts\IEAuditCluase;
use App\Traits\Charts\IncidentChart;
use App\Traits\Charts\PtwChart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LineChartController extends Controller
{
    use ChartHelperMethods, IncidentChart, PtwChart, IEAuditCluase;
    public function index(Request $request, $channel = "web")
    {
        $data = [];

        if ($request->has('data_by')) {
            if ($request->data_by == "daily") {
                $data = $this->dailyLineChartOfAMonth($request);
            }
            if ($request->data_by == "monthly") {
                $data = $this->monthlyLineChartOfYear($request);
            }
            if ($request->data_by == "yearly") {
                $data = $this->yearlyLineChartOfTenYears($request);
            }
        }

        if ($channel === "api") {
            return ApiResponseController::successWithJustData($data);
        }

        return $data;
    }
    public function prepareForLineChart(Request $request, $channel = 'web')
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

        // if ($channel == 'api') {
        return $this->indexAllTimes($requestsArray, 'api');
        // }
    }

    private function createRequest($dataBy, $chart_of, $incident_name = "all")
    {
        $request = Request::create('/');
        $request->merge(['data_by' => $dataBy, 'chart_of' => $chart_of, 'incident' => $incident_name]); // Set the desired property
        return $request;
    }

    public function indexAllTimes($requests, $channel = "web")
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
            $data[$keyName] = $this->index($request, 'web');
        }
        if ($channel === "api") {
            return ApiResponseController::successWithJustData($data);
        }

    }

    public function dailyLineChartOfAMonth(Request $request)
    {
        $results = [];
        $datesInMonth = $this::datesInMonth();
        if ($request->has('month')) {
            $datesInMonth = $this::datesInMonth($request->month);
        }
        $daysNamesInMonth[] = $this::daysNameInMonth($datesInMonth);

        foreach ($datesInMonth as $date) {
            if ($request->has('chart_of') && $request->chart_of == 'incidents') {
                $results[] = $this::incidentLineChartData($request, $date);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ptws') {
                $results[] = $this::ptwsLineChartData($request, $date);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
                $results[] = $this::ieAuditLineChartData($request, $date);
            }
        }

        return [
            'label' => array_reverse($datesInMonth),
            'label2' => array_reverse($daysNamesInMonth),
            'value' => array_reverse($results)
        ];
    }

    public function monthlyLineChartOfYear(Request $request)
    {
        $results = [];
        $monthsArray = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'Sept', 'October', 'November', 'December'];

        if ($request->has('year')) {
            $year = $request->year;
        } else {
            $year = Carbon::now()->year;

        }

        for ($i = 1; $i <= 12; $i++) {
            $firstDateOfMonth = Carbon::parse("{$year}-{$i}-01");
            if ($request->has('chart_of') && $request->chart_of == 'incidents') {
                $results[] = $this::incidentLineChartData($request, $firstDateOfMonth);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ptws') {
                $results[] = $this::ptwsLineChartData($request, $firstDateOfMonth);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
                $results[] = $this::ieAuditLineChartData($request, $firstDateOfMonth);
            }
        }

        return [
            'label' => array_reverse($monthsArray),
            'value' => array_reverse($results)
        ];
    }

    public function yearlyLineChartOfTenYears(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $previousYears = [];
        $results = [];
        for ($i = 0; $i < 10; $i++) {
            $previousYears[] = $year = $currentYear - $i;
            $firstDateOfYear = Carbon::parse("{$year}-01-01");
            if ($request->has('chart_of') && $request->chart_of == 'incidents') {
                $results[] = $this::incidentLineChartData($request, $firstDateOfYear);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ptws') {
                $results[] = $this::ptwsLineChartData($request, $firstDateOfYear);
            }
            if ($request->has('chart_of') && $request->chart_of == 'ie_audit') {
                $results[] = $this::ieAuditLineChartData($request, $firstDateOfYear);
            }
        }

        return [
            'label' => array_reverse($previousYears),
            'value' => array_reverse($results)
        ];
    }




}