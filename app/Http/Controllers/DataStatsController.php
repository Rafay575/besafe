<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\InternalExternalAuditClause;
use App\Models\NearMiss;
use App\Models\PermitToWork;
use App\Models\UnsafeBehavior;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataStatsController extends Controller
{
    public function index(Request $request, $channel = "web")
    {
        $data = [];
        if ($request->has('stats_of') && $request->stats_of != "") {

            if ($request->stats_of === "incidents") {
                $data[] = $this->incidentStats($request);
            }

            if ($request->stats_of === "ptws") {
                $data[] = $this->ptwStats($request);
            }
            if ($request->stats_of === "users") {
                $data[] = $this->usersStats($request);
            }
            if ($request->stats_of === "ie_audit") {
                $data[] = $this->ieAuditStats($request);
            }

            return ApiResponseController::successWithJustData($data);

        } else {
            return ApiResponseController::error('please provide valid stats_of');
        }

    }

    public function usersStats(Request $request)
    {
        $query = User::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('role')) {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('name', $request->role);
            });
        }

        if ($request->has('from_date') && $request->has('to_date')) {
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        return ['users' => $query->count()];
    }
    public function ieAuditStats(Request $request)
    {
        $query = InternalExternalAuditClause::query();

        if ($request->has('initiated_by')) {
            $query->where('initiated_by', $request->initiated_by);
        }

        if ($request->has('from_date') && $request->has('to_date')) {
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        return ['ie_audits' => $query->count()];
    }
    public function ptwStats(Request $request)
    {
        $query = PermitToWork::query();

        if ($request->has('initiated_by')) {
            $query->where('initiated_by', $request->initiated_by);
        }

        if ($request->has('from_date') && $request->has('to_date')) {
            $start = Carbon::parse($request->from_date)->startOfDay();
            $end = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        return ['ptws' => $query->count()];
    }
    public function incidentStats(Request $request)
    {
        $data = [];
        if ($request->has('incident') && $request->incident != "") {
            $requestedIncidents = explode(',', $request->incident);

            $models = [
                'hazard' => Hazard::class,
                'unsafe_behavior' => UnsafeBehavior::class,
                'near_miss' => NearMiss::class,
                'fire_property_damage' => FirePropertyDamage::class,
                'injury' => Injury::class,
            ];
            foreach ($requestedIncidents as $incidentModelClassKey) {
                if (array_key_exists($incidentModelClassKey, $models)) {
                    $query = $models[$incidentModelClassKey]::query();

                    // Apply filters based on the request parameters
                    if ($request->has('incident_status')) {
                        $query->where('meta_incident_status_id', $request->incident_status);
                    }

                    if ($request->has('initiated_by')) {
                        $query->where('initiated_by', $request->initiated_by);
                    }

                    if ($request->has('from_date') && $request->has('to_date')) {
                        $start = Carbon::parse($request->from_date)->startOfDay();
                        $end = Carbon::parse($request->to_date)->endOfDay();
                        $query->whereBetween('created_at', [$start, $end]);
                    }
                    $data[$incidentModelClassKey] = $query->count() ?? 0;
                    $total = (array_key_exists('total', $data)) ? $data['total'] : 0;
                    $data['total'] = $query->count() + $total;
                }

            }

        } else {
            return ApiResponseController::error('please pass valid incident_name');
        }

        // shiftin total key to the last 
        if (array_key_exists('total', $data)) {
            $value = $data['total'];
            unset($data['total']);
            $data['total'] = $value;
        }
        return $data;
    }
}