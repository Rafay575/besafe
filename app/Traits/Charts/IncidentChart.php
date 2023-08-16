<?php
namespace App\Traits\Charts;

use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\MetaDepartment;
use App\Models\MetaDepartmentTag;
use App\Models\MetaFireCategory;
use App\Models\MetaIncidentCategory;
use App\Models\MetaIncidentStatus;
use App\Models\MetaInjuryCategory;
use App\Models\MetaLine;
use App\Models\MetaPropertyDamage;
use App\Models\MetaRiskLevel;
use App\Models\MetaUnit;
use App\Models\NearMiss;
use App\Models\UnsafeBehavior;
use App\Models\User;
use Carbon\Carbon;

trait IncidentChart
{
    public static function incidentLineChartData($request, $date)
    {
        if (!$request->has('incident') or $request->incident === 'all') {
            return self::incidentsCountOnADate($date, $request);
        }
        if ($request->incident === 'hazard') {
            return self::incidentsCountOnADate($date, $request, Hazard::class);
        }
        if ($request->incident === 'near_miss') {
            return self::incidentsCountOnADate($date, $request, NearMiss::class);
        }
        if ($request->incident === 'fire_property_damage') {
            return self::incidentsCountOnADate($date, $request, FirePropertyDamage::class);
        }
        if ($request->incident === 'injury') {
            return self::incidentsCountOnADate($date, $request, Injury::class);
        }
        if ($request->incident === 'unsafe_behavior') {
            return self::incidentsCountOnADate($date, $request, UnsafeBehavior::class);
        }
    }
    public static function incidentsCountOnADate($date, $request, $model = null)
    {
        $date = Carbon::parse($date);
        // if request has specific incident requirment
        if ($model) {
            $incident = $model::query();
            if ($request->has('data_by')) {
                switch ($request->data_by) {
                    case 'monthly':
                        $incident = $incident->whereMonth('date', $date->month)->whereYear('date', $date->year);
                        break;
                    case 'yearly':
                        $incident = $incident->whereYear('date', $date->year);
                        break;

                    default:
                        $incident = $incident->whereDate('date', $date);
                        break;
                }
            } else {
                $incident = $incident->whereDate('date', $date);
            }
            if ($request->has('incident_status')) {
                $incident = $incident->where('meta_incident_status_id', $request->incident_status);
            }
            if ($request->has('initiated_by')) {
                $incident = $incident->where('initiated_by', $request->initiated_by);
            }
            return $incident->get()->count();
        }

        // if request does not has specific requirment then we will show all incidents
        $commonColumns = ['id', 'initiated_by', 'created_at', 'updated_at', 'meta_incident_status_id'];
        $hazards = Hazard::select($commonColumns)
            ->selectRaw("'hazards' AS incident_name");


        $nearMisses = NearMiss::select($commonColumns)
            ->selectRaw("'near_misses' AS incident_name");


        $unsafe_behaviors = UnsafeBehavior::select($commonColumns)
            ->selectRaw("'unsafe_behaviors' AS incident_name");

        $injuries = Injury::select($commonColumns)
            ->selectRaw("'injuries' AS incident_name");

        $fpdemages = FirePropertyDamage::select($commonColumns)
            ->selectRaw("'fpdamages' AS incident_name");

        // if data_by is asked such as monthly,year. if not then we return daily
        $acceptableDataBy = ['monthly', 'daily', 'yearly'];
        if ($request->has('data_by') && in_array($request->data_by, $acceptableDataBy)) {
            if ($request->data_by == "daily") {
                $fpdemages = $fpdemages->whereDate('date', $date);
                $injuries = $injuries->whereDate('date', $date);
                $unsafe_behaviors = $unsafe_behaviors->whereDate('date', $date);
                $nearMisses = $nearMisses->whereDate('date', $date);
                $hazards = $hazards->whereDate('date', $date);
            }

            if ($request->data_by == "monthly") {
                $fpdemages = $fpdemages->whereMonth('date', $date->month)->whereYear('date', $date->year);
                $injuries = $injuries->whereMonth('date', $date->month)->whereYear('date', $date->year);
                $unsafe_behaviors = $unsafe_behaviors->whereMonth('date', $date->month)->whereYear('date', $date->year);
                $nearMisses = $nearMisses->whereMonth('date', $date->month)->whereYear('date', $date->year);
                $hazards = $hazards->whereMonth('date', $date->month)->whereYear('date', $date->year);
            }
            if ($request->data_by == "yearly") {
                $fpdemages = $fpdemages->whereYear('date', $date->year);
                $injuries = $injuries->whereYear('date', $date->year);
                $unsafe_behaviors = $unsafe_behaviors->whereYear('date', $date->year);
                $nearMisses = $nearMisses->whereYear('date', $date->year);
                $hazards = $hazards->whereYear('date', $date->year);
            }
        } else {

            $fpdemages = $fpdemages->whereDate('date', $date);
            $injuries = $injuries->whereDate('date', $date);
            $unsafe_behaviors = $unsafe_behaviors->whereDate('date', $date);
            $nearMisses = $nearMisses->whereDate('date', $date);
            $hazards = $hazards->whereDate('date', $date);
        }

        // filters
        if ($request->has('incident_status')) {
            $hazards = $hazards->where('meta_incident_status_id', $request->incident_status);
            $unsafe_behaviors = $unsafe_behaviors->where('meta_incident_status_id', $request->incident_status);
            $injuries = $injuries->where('meta_incident_status_id', $request->incident_status);
            $nearMisses = $nearMisses->where('meta_incident_status_id', $request->incident_status);
            $fpdemages = $fpdemages->where('meta_incident_status_id', $request->incident_status);
        }
        if ($request->has('initiated_by')) {
            $hazards = $hazards->where('initiated_by', $request->initiated_by);
            $unsafe_behaviors = $unsafe_behaviors->where('initiated_by', $request->initiated_by);
            $injuries = $injuries->where('initiated_by', $request->initiated_by);
            $nearMisses = $nearMisses->where('initiated_by', $request->initiated_by);
            $fpdemages = $fpdemages->where('initiated_by', $request->initiated_by);
        }
        return $hazards->unionAll($nearMisses)
            ->unionAll($unsafe_behaviors)
            ->unionAll($injuries)
            ->unionAll($fpdemages)
            ->get()->count();
    }
    public static function incidentCardChartData($request, $groupBy)
    {
        if ($request->incident === 'all') {
            return self::incidentGroupData($groupBy, $request);
        }
        if ($request->incident === 'hazard') {
            return self::incidentGroupData($groupBy, $request, Hazard::class);
        }
        if ($request->incident === 'near_miss') {
            return self::incidentGroupData($groupBy, $request, NearMiss::class);
        }
        if ($request->incident === 'fire_property_damage') {
            return self::incidentGroupData($groupBy, $request, FirePropertyDamage::class);
        }
        if ($request->incident === 'injury') {
            return self::incidentGroupData($groupBy, $request, Injury::class);
        }
        if ($request->incident === 'unsafe_behavior') {
            return self::incidentGroupData($groupBy, $request, UnsafeBehavior::class);
        }
    }

    public static function incidentGroupData($groupBy, $request, $model = null)
    {
        $labels = [];
        $data = [];
        $acceptableGroupBy = [
            UnsafeBehavior::class => [
                'meta_line_id' => [
                    'title_colum' => 'line_title',
                    'modelClass' => MetaLine::class,
                ],
                'meta_unit_id' => [
                    'title_colum' => 'unit_title',
                    'modelClass' => MetaUnit::class,
                ],
                'meta_department_id' => [
                    'title_colum' => 'department_title',
                    'modelClass' => MetaDepartment::class,
                ],
                'meta_incident_status_id' => [
                    'title_colum' => 'status_title',
                    'modelClass' => MetaIncidentStatus::class,
                ],
                'initiated_by' => [
                    'title_colum' => 'email',
                    'modelClass' => User::class,
                ],
            ],
            NearMiss::class => [
                'meta_incident_status_id' => [
                    'title_colum' => 'status_title',
                    'modelClass' => MetaIncidentStatus::class,
                ],
                'initiated_by' => [
                    'title_colum' => 'email',
                    'modelClass' => User::class,
                ],
            ],
            Injury::class => [
                'meta_incident_status_id' => [
                    'title_colum' => 'status_title',
                    'modelClass' => MetaIncidentStatus::class,
                ],
                'initiated_by' => [
                    'title_colum' => 'email',
                    'modelClass' => User::class,
                ],
                'meta_injury_category_id' => [
                    'title_colum' => 'injury_category_title',
                    'modelClass' => MetaInjuryCategory::class,
                ],
                'meta_incident_category_id' => [
                    'title_colum' => 'incident_category_title',
                    'modelClass' => MetaIncidentCategory::class,
                ],
            ],
            Hazard::class => [
                'meta_line_id' => [
                    'title_colum' => 'line_title',
                    'modelClass' => MetaLine::class,
                ],
                'meta_unit_id' => [
                    'title_colum' => 'unit_title',
                    'modelClass' => MetaUnit::class,
                ],
                'meta_department_id' => [
                    'title_colum' => 'department_title',
                    'modelClass' => MetaDepartment::class,
                ],
                'meta_risk_level_id' => [
                    'title_colum' => 'risk_level_title',
                    'modelClass' => MetaRiskLevel::class,
                ],
                'meta_department_tag_id' => [
                    'title_colum' => 'department_tag_title',
                    'modelClass' => MetaDepartmentTag::class,
                ],
                'meta_incident_status_id' => [
                    'title_colum' => 'status_title',
                    'modelClass' => MetaIncidentStatus::class,
                ],
                'initiated_by' => [
                    'title_colum' => 'email',
                    'modelClass' => User::class,
                ],
            ],

            FirePropertyDamage::class => [
                'meta_incident_status_id' => [
                    'title_colum' => 'status_title',
                    'modelClass' => MetaIncidentStatus::class,
                ],
                'initiated_by' => [
                    'title_colum' => 'email',
                    'modelClass' => User::class,
                ],
                'meta_unit_id' => [
                    'title_colum' => 'unit_title',
                    'modelClass' => MetaUnit::class,
                ],
                'meta_fire_category_id' => [
                    'title_colum' => 'fire_category_title',
                    'modelClass' => MetaFireCategory::class,
                ],
                'meta_property_damage_id' => [
                    'title_colum' => 'property_damage_title',
                    'modelClass' => MetaPropertyDamage::class,
                ],
            ],

        ];

        // if request has specific incident requirment
        if ($model) {
            $incident = $model::latest();

            // if date range is requested
            if ($request->has('from_date') && $request->has('to_date')) {
                $incident = $incident->whereBetween('date', [$request->from_date, $request->to_date]);
            }

            if ($request->has('incident_status')) {
                $incident = $incident->where('meta_incident_status_id', $request->incident_status);
            }
            if ($request->has('initiated_by')) {
                $incident = $incident->where('initiated_by', $request->initiated_by);
            }
            if ($groupBy === 'month') {
                $incident = $incident->get()
                    ->groupBy(function ($item) {
                        return $item->created_at->month;
                    });
            } elseif ($groupBy == "day") {
                $incident = $incident->get()
                    ->groupBy(function ($item) {
                        return $item->created_at->day;
                    });
            } elseif ($groupBy == "year") {
                $incident = $incident->get()
                    ->groupBy(function ($item) {
                        return $item->created_at->year;
                    });
            } elseif (@$acceptableGroupBy[$model][$groupBy]) {
                $incident = $incident->get()
                    ->groupBy($groupBy);
            }

            foreach ($incident as $key => $value) {
                if ($groupBy == "month") {
                    $labels[] = Carbon::parse($value[0]->created_at)->format('M-Y');
                    $data[] = count($value);
                } elseif ($groupBy === 'day') {
                    $labels[] = Carbon::parse($value[0]->created_at)->format('d-m-Y');
                    $data[] = count($value);
                } elseif ($groupBy === 'year') {
                    $labels[] = Carbon::parse($value[0]->created_at)->format('Y');
                    $data[] = count($value);
                } elseif (@$acceptableGroupBy[$model][$groupBy]) {
                    $title = $acceptableGroupBy[$model][$groupBy]['title_colum'];
                    $labels[] = $acceptableGroupBy[$model][$groupBy]['modelClass']::find($key)->$title;
                    $data[] = count($value);
                }
            }
            return ["labels" => $labels, "data" => $data];

        }

        // if request does not has specific requirment then we will show all incidents
        $commonColumns = ['id', 'initiated_by', 'created_at', 'updated_at', 'meta_incident_status_id'];
        $hazards = Hazard::select($commonColumns)
            ->selectRaw("'hazards' AS incident_name");


        $nearMisses = NearMiss::select($commonColumns)
            ->selectRaw("'near_misses' AS incident_name");


        $unsafe_behaviors = UnsafeBehavior::select($commonColumns)
            ->selectRaw("'unsafe_behaviors' AS incident_name");

        $injuries = Injury::select($commonColumns)
            ->selectRaw("'injuries' AS incident_name");

        $fpdemages = FirePropertyDamage::select($commonColumns)
            ->selectRaw("'fpdamages' AS incident_name");

        // if date range is requested
        if ($request->has('from_date') && $request->has('to_date')) {
            $fpdemages = $fpdemages->whereBetween('date', [$request->from_date, $request->to_date]);
            $injuries = $injuries->whereBetween('date', [$request->from_date, $request->to_date]);
            $unsafe_behaviors = $unsafe_behaviors->whereBetween('date', [$request->from_date, $request->to_date]);
            $nearMisses = $nearMisses->whereBetween('date', [$request->from_date, $request->to_date]);
            $hazards = $hazards->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        // filters
        if ($request->has('incident_status')) {
            $hazards = $hazards->where('meta_incident_status_id', $request->incident_status);
            $unsafe_behaviors = $unsafe_behaviors->where('meta_incident_status_id', $request->incident_status);
            $injuries = $injuries->where('meta_incident_status_id', $request->incident_status);
            $nearMisses = $nearMisses->where('meta_incident_status_id', $request->incident_status);
            $fpdemages = $fpdemages->where('meta_incident_status_id', $request->incident_status);
        }
        if ($request->has('initiated_by')) {
            $hazards = $hazards->where('initiated_by', $request->initiated_by);
            $unsafe_behaviors = $unsafe_behaviors->where('initiated_by', $request->initiated_by);
            $injuries = $injuries->where('initiated_by', $request->initiated_by);
            $nearMisses = $nearMisses->where('initiated_by', $request->initiated_by);
            $fpdemages = $fpdemages->where('initiated_by', $request->initiated_by);
        }

        $results = $hazards->unionAll($nearMisses)
            ->unionAll($unsafe_behaviors)
            ->unionAll($injuries)
            ->unionAll($fpdemages)
            ->get();

        if ($groupBy === "month") {
            $results = $results->groupBy(function ($item) {
                return $item->created_at->month;
            });
        } elseif ($groupBy === "day") {
            $results = $results->groupBy(function ($item) {
                return $item->created_at->day;
            });
        } elseif ($groupBy === "year") {
            $results = $results->groupBy(function ($item) {
                return $item->created_at->year;
            });
        }

        foreach ($results as $key => $value) {
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