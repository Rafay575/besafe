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
        $date = Carbon::now();
        if ($request->has('date') && $request->date != "") {
            $date = Carbon::parse($request->date);
        }
        $requestsArray = [];
        if ($request->data_by === 'daily') {
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'unsafe_behavior');
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'all');
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'fire_property_damage');
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'hazard');
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'injury');
            $requestsArray[] = $this->createRequest($date, 'daily', 'incidents', 'near_miss');
            $requestsArray[] = $this->createRequest($date, 'daily', 'ptws');
            $requestsArray[] = $this->createRequest($date, 'daily', 'ie_audit');
        }

        if ($request->data_by === 'monthly') {
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'all');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'hazard');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'unsafe_behavior');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'fire_property_damage');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'near_miss');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'ie_audit');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'incidents', 'injury');
            $requestsArray[] = $this->createRequest($date, 'monthly', 'ptws');
        }

        if ($request->data_by == 'yearly') {
            $requestsArray[] = $this->createRequest($date, 'yearly', 'ptws');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'ie_audit');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'hazard');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'all');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'unsafe_behavior');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'fire_property_damage');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'injury');
            $requestsArray[] = $this->createRequest($date, 'yearly', 'incidents', 'near_miss');
        }

        // if ($channel == 'api') {
        return $this->indexAllTimes($requestsArray, 'api');
        // }
    }

    private function createRequest($date, $dataBy, $chart_of, $incident_name = "all")
    {
        $request = Request::create('/');
        $request->merge(['month' => $date, 'year' => $date, 'data_by' => $dataBy, 'chart_of' => $chart_of, 'incident' => $incident_name]); // Set the desired property
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
            'label' => $datesInMonth,
            'label2' => $daysNamesInMonth,
            'value' => $results
        ];
    }

    public function monthlyLineChartOfYear(Request $request)
    {
        $results = [];
        $monthsArray = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'Sept', 'October', 'November', 'December'];

        if ($request->has('year')) {
            $year = Carbon::parse($request->year)->year;
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
            'label' => $monthsArray,
            'value' => $results
        ];
    }

    public function yearlyLineChartOfTenYears(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $previousYears = [];
        $results = [];
        for ($i = 0; $i < 3; $i++) {
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