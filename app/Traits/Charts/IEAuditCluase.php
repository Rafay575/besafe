<?php
namespace App\Traits\Charts;


use App\Models\InternalExternalAuditClause;

use Carbon\Carbon;

trait IEAuditCluase
{
    public static function ieAuditLineChartData($request, $date)
    {
        $date = Carbon::parse($date);
        // if request has specific incident requirment
        $acceptableDataBy = ['monthly', 'daily', 'yearly'];
        if ($request->has('data_by') && in_array($request->data_by, $acceptableDataBy)) {
            if ($request->data_by == "daily") {
                $ieAudit = InternalExternalAuditClause::whereDate('created_at', $date);
            }
            if ($request->data_by == "monthly") {
                $ieAudit = InternalExternalAuditClause::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year);
            }
            if ($request->data_by == "yearly") {
                $ieAudit = InternalExternalAuditClause::whereYear('created_at', $date->year);
            }

        } else {
            $ieAudit = InternalExternalAuditClause::whereDate('created_at', $date);
        }
        if ($request->has('initiated_by')) {
            $ieAudit = $ieAudit->where('initiated_by', $request->initiated_by);
        }
        return $ieAudit->get()->count();

    }
    public static function IEAuditCardChartData($request, $groupBy)
    {
        $labels = [];
        $data = [];

        $ieAudit = InternalExternalAuditClause::latest();
        if ($request->has('from_date') && $request->has('to_date')) {
            $ieAudit = $ieAudit->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
        if ($request->has('initiated_by')) {
            $ieAudit = $ieAudit->where('initiated_by', $request->initiated_by);
        }
        if ($groupBy === 'month') {
            $ieAudit = $ieAudit->get()
                ->groupBy(function ($item) {
                    return $item->created_at->month;
                });
        } elseif ($groupBy == "day") {
            $ieAudit = $ieAudit->get()
                ->groupBy(function ($item) {
                    return $item->created_at->day;
                });
        } elseif ($groupBy == "year") {
            $ieAudit = $ieAudit->get()
                ->groupBy(function ($item) {
                    return $item->created_at->year;
                });
        }

        foreach ($ieAudit as $key => $value) {
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
        return ["labels" => $labels, "value" => $data];
    }
}