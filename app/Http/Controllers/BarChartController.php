<?php

namespace App\Http\Controllers;

use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\MetaDepartment;
use App\Models\MetaFireCategory;
use App\Models\MetaIncidentCategory;
use App\Models\MetaInjuryCategory;
use App\Models\MetaPtwType;
use App\Models\MetaRiskLevel;
use App\Models\PermitToWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarChartController extends Controller
{
    public function prepareForBarChart(Request $request, $channel = "web")
    {
        return [
            'ptw_type_wise' => $this->ptw_type_wise($request),
            'fpd_category_wise' => $this->fpd_category_wise($request),
            'injury_category_wise' => $this->injury_category_wise($request),
            'injury_incident_cat_wise' => $this->injury_incident_cat_wise($request),
            'injury_investigation' => $this->injury_investigation($request),
            'hazard_risk_wise' => $this->hazard_risk_wise($request),
            'hazard_department_wise' => $this->hazard_department_wise($request),
            'hazard_status_wise' => $this->hazard_status_wise($request),
        ];
    }
    // ptw
    public function ptw_type_wise(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = MetaPtwType::all()->pluck('ptw_type_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = PermitToWork::whereBetween('created_at', [$from_date, $to_date])->whereHas('ptw_types', function ($query) use ($label) {
                $query->where('ptw_type_title', $label);
            })->count();
        }
        return [
            "labels" => $labels,
            "data" => $data,
        ];

    }

    // fire property damages
    public function fpd_category_wise(Request $request)
    {

        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = MetaFireCategory::all()->pluck('fire_category_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = FirePropertyDamage::whereBetween('created_at', [$from_date, $to_date])->whereHas('fire_category', function ($query) use ($label) {
                $query->where('fire_category_title', $label);
            })->count();
        }
        $labels[] = 'Total';
        $data[] = array_sum($data);
        return [
            "labels" => $labels,
            "data" => $data,
        ];

    }

    // injuries

    public function injury_category_wise(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = MetaInjuryCategory::all()->pluck('injury_category_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = Injury::whereBetween('created_at', [$from_date, $to_date])->whereHas('injury_category', function ($query) use ($label) {
                $query->where('injury_category_title', $label);
            })->count();
        }
        return [
            "labels" => $labels,
            "data" => $data,
        ];
    }

    public function injury_incident_cat_wise(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }


        $labels = MetaIncidentCategory::all()->pluck('incident_category_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = Injury::whereBetween('created_at', [$from_date, $to_date])->whereHas('incident_category', function ($query) use ($label) {
                $query->where('incident_category_title', $label);
            })->count();
        }
        return [
            "labels" => $labels,
            "data" => $data,
        ];
    }


    public function injury_investigation(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = ['Injury Reported', 'Injury Investigated', 'Total Action Taken', 'Action Closed', 'Action Pending'];
        $data = [];
        $data[] = Injury::whereBetween('created_at', [$from_date, $to_date])->count(); //total reported

        $data[] = Injury::whereBetween('created_at', [$from_date, $to_date])->whereHas('incident_status', function ($query) {
            $query->whereNot('status_code', 0);
        })->count(); //not pending injures

        $data[] = self::countJson(Injury::whereBetween('created_at', [$from_date, $to_date])->get()); //total actions taken
        $data[] = self::countJson(Injury::whereBetween('created_at', [$from_date, $to_date])->get(), ['where' => ['column' => 'status', 'value' => 'inactive']]); //action closed
        $data[] = self::countJson(Injury::whereBetween('created_at', [$from_date, $to_date])->get(), ['where' => ['column' => 'status', 'value' => 'active']]); //action pending




        return [
            "labels" => $labels,
            "data" => $data,
        ];

    }

    // hazard
    public function hazard_risk_wise(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = MetaRiskLevel::all()->pluck('risk_level_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = Hazard::whereBetween('created_at', [$from_date, $to_date])->whereHas('risk_level', function ($query) use ($label) {
                $query->where('risk_level_title', $label);
            })->count();
        }
        return [
            "labels" => $labels,
            "data" => $data,
        ];
    }

    public function hazard_department_wise(Request $request)
    {
        $today = Carbon::now();
        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');
        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }

        $labels = MetaDepartment::all()->pluck('department_title')->toArray();
        $data = [];
        foreach ($labels as $label) {
            $data[] = Hazard::whereBetween('created_at', [$from_date, $to_date])->whereHas('department', function ($query) use ($label) {
                $query->where('department_title', $label);
            })->count();
        }
        return [
            "labels" => $labels,
            "data" => $data,
        ];
    }

    public function hazard_status_wise(Request $request)
    {
        $labels = ['Number of Actions Closed for Hazard', 'Pending Actions', 'Total Closer'];
        $data = [];
        $today = Carbon::now();

        $from_date = $today->firstOfMonth()->format('d-m-y');
        $to_date = $today->lastOfMonth()->format('d-m-y');

        if ($request->has('from_date') && !empty($request->from_date) && $request->has('to_date') && !empty($request->to_date)) {
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }


        $data[] = Hazard::whereBetween('created_at', [$from_date, $to_date])->whereHas('incident_status', function ($query) {
            $query->where('status_code', 3);
        })->count(); //completed hazard

        $data[] = Hazard::whereBetween('created_at', [$from_date, $to_date])->whereHas('incident_status', function ($query) {
            $query->where('status_code', 0);
        })->count(); //pending hazard

        $data[] = Hazard::whereBetween('created_at', [$from_date, $to_date])->count(); //total hazard

        return [
            "labels" => $labels,
            "data" => $data,
        ];
    }



    public static function countJson($collection, array $options = [])
    {
        // $options = [
        //     'where' => ['column' => 'sno', 'value' => 1],
        //     'column' => 'actions',
        // ];
        $count = 0;
        // Loop through each injury and extract the value of the specific key from the actions JSON
        foreach ($collection as $item) {
            $jsonData = $item->actions;
            if (array_key_exists('column', $options)) {
                $jsonData = $item->{$options['column']};
            }
            if (!empty($jsonData)) {
                foreach ($jsonData as $item) {
                    if (array_key_exists('where', $options)) {
                        // return $item[$options['where']['column']];
                        if ($item[$options['where']['column']] == $options['where']['value']) {
                            $count++;
                        }
                    } else {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }


}