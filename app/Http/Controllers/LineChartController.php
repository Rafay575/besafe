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
        $data = $this->dailyLineChartOfAMonth($request);

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
            'datesInMonth' => $datesInMonth,
            'daysNameInMonth' => $daysNamesInMonth,
            'countDataByDay' => $results
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
            'months' => $monthsArray,
            'countDataByMonth' => $results
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
            'years' => $previousYears,
            'countDataByYear' => $results
        ];
    }




}