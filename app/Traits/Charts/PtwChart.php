<?php
namespace App\Traits\Charts;


use App\Models\PermitToWork;
use Carbon\Carbon;

trait PtwChart
{
    public static function ptwsLineChartData($request, $date)
    {
        $date = Carbon::parse($date);
        // if request has specific incident requirment
        $acceptableDataBy = ['monthly', 'daily', 'yearly'];
        if ($request->has('data_by') && in_array($request->data_by, $acceptableDataBy)) {
            if ($request->data_by == "daily") {
                $ptws = PermitToWork::whereDate('created_at', $date);
            }
            if ($request->data_by == "monthly") {
                $ptws = PermitToWork::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year);
            }
            if ($request->data_by == "yearly") {
                $ptws = PermitToWork::whereYear('created_at', $date->year);
            }

        } else {
            $ptws = PermitToWork::whereDate('created_at', $date);
        }
        if ($request->has('initiated_by')) {
            $ptws = $ptws->where('initiated_by', $request->initiated_by);
        }
        return $ptws->get()->count();

    }
    public static function ptwsCardChartData($request, $groupBy)
    {
        $labels = [];
        $data = [];

        $ptws = PermitToWork::latest();
        if ($request->has('from_date') && $request->has('to_date')) {
            $ptws = $ptws->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
        if ($request->has('initiated_by')) {
            $ptws = $ptws->where('initiated_by', $request->initiated_by);
        }
        if ($groupBy === 'month') {
            $ptws = $ptws->get()
                ->groupBy(function ($item) {
                    return $item->created_at->month;
                });
        } elseif ($groupBy == "day") {
            $ptws = $ptws->get()
                ->groupBy(function ($item) {
                    return $item->created_at->day;
                });
        } elseif ($groupBy == "year") {
            $ptws = $ptws->get()
                ->groupBy(function ($item) {
                    return $item->created_at->year;
                });
        }

        foreach ($ptws as $key => $value) {
            if ($groupBy == "month") {
                $labels[] = Carbon::parse($value[0]->created_at)->format('M-Y');
                $data[] = count($value);
            } elseif ($groupBy === 'day') {
                $labels[] = Carbon::parse($value[0]->created_at)->format('d-m-Y');
                $data[] = count($value);
            } elseif ($groupBy === 'year') {
                $labels[] = Carbon::parse($value[0]->created_at)->format('Y');
                $data[] = count($value);
            }
        }
        return ["labels" => $labels, "data" => $data];
    }

}