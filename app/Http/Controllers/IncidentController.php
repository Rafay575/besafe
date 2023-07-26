<?php

namespace App\Http\Controllers;

use App\Http\Resources\IncidentCollection;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\Injury;
use App\Models\NearMiss;
use App\Models\UnsafeBehavior;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IncidentController extends Controller
{
    public function index(Request $request, $channel = "web")
    {
        $commonColumns = ['id', 'initiated_by', 'created_at', 'updated_at', 'meta_incident_status_id'];
        $hazards = Hazard::select($commonColumns)
            ->selectRaw("'hazards' AS incident_name")
            ->selectRaw("'hazards' AS form_name")
            ->selectRaw("'hazards' AS route_name")
            ->selectRaw("'hazard' AS perm_name");
        $hazards = IncidentAssignController::getAssignedIncidents($hazards, 'hazard');
        $nearMisses = NearMiss::select($commonColumns)
            ->selectRaw("'near_misses' AS incident_name")
            ->selectRaw("'near_misses' AS form_name")
            ->selectRaw("'near-miss' AS route_name")
            ->selectRaw("'near_miss' AS perm_name");

        $nearMisses = IncidentAssignController::getAssignedIncidents($nearMisses, 'near_miss');


        $unsafe_behaviors = UnsafeBehavior::select($commonColumns)
            ->selectRaw("'unsafe_behaviors' AS incident_name")
            ->selectRaw("'unsafe_behaviors' AS form_name")
            ->selectRaw("'unsafe-behaviors' AS route_name")
            ->selectRaw("'unsafe_behavior' AS perm_name");

        $unsafe_behaviors = IncidentAssignController::getAssignedIncidents($unsafe_behaviors, 'unsafe_behavior');



        $injuries = Injury::select($commonColumns)
            ->selectRaw("'injuries' AS incident_name")
            ->selectRaw("'injuries' AS form_name")
            ->selectRaw("'injuries' AS route_name")
            ->selectRaw("'injury' AS perm_name");
        $injuries = IncidentAssignController::getAssignedIncidents($injuries, 'injury');


        $fpdemages = FirePropertyDamage::select($commonColumns)
            ->selectRaw("'fpdamages' AS incident_name")
            ->selectRaw("'fire_property_damages' AS form_name")
            ->selectRaw("'fire-property' AS route_name")
            ->selectRaw("'fire_property_damage' AS perm_name");

        $fpdemages = IncidentAssignController::getAssignedIncidents($fpdemages, 'fire_property');


        $results = $hazards->unionAll($nearMisses)
            ->unionAll($unsafe_behaviors)
            ->unionAll($injuries)
            ->unionAll($fpdemages)
            ->orderBy('created_at', 'desc');


        $limit = 20;
        if ($request->has('limit')) {
            $limit = $request->limit;
        }
        if ($request->has('from_date') and $request->has('to_date')) {
            $results = $results->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        if ($request->has('meta_incident_status_id')) {
            $results = $results->where('meta_incident_status_id', $request->meta_incident_status_id);
        }
        if ($request->has('initiated_by')) {
            $results = $results->where('initiated_by', $request->initiated_by);
        }


        if ($channel == "api") {
            $results = $results->paginate($limit);
            return $results;
        }


        $incidents = $results->with('initiator', 'incident_status')->get();
        $incident = $incidents->first();
        // return $incidents = $results->with('initiator', 'incident_status')->first()->assignedUsersAll->where('form_name', 'unsafe_behaviors')->first();
        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($incidents as $incident) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'incident_id' => $incident->id,
                    'created_at' => $incident->created_at->format('d-m-Y'),
                    'updated_at' => $incident->updated_at->format('d-m-Y'),
                    'incident_name' => $incident->incident_name,
                    'incident_status' => $incident->incident_status->status_title,
                    'initiator_department_id' => $incident->initiator->meta_department_id,
                    'initiated_by' => $incident->initiator->first_name . " " . $incident->initiator->last_name,
                    'action' => view('incidents.partials.action-buttons', ['incident' => $incident])->render()

                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('incidents.index');
    }
}