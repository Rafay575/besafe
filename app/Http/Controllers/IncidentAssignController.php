<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\IncidentAssignCollection;
use App\Models\FirePropertyDamage;
use App\Models\Hazard;
use App\Models\IncidentAssign;
use App\Models\Injury;
use App\Models\MetaIncidentStatus;
use App\Models\NearMiss;
use App\Models\UnsafeBehavior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncidentAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeByIncidentName(Request $request, $channel = "web")
    {
        $validator = Validator::make($request->all(), [
            'incident_id' => 'required',
            'incident_name' => 'required|in:hazards,near_misses,unsafe_behaviors,injuries,fpdamages',
        ]);


        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $incidentsModelsArray = $this->getIncidentModelViaKeys();

        return $this->store($request, $incidentsModelsArray[$request->incident_name]::where('id', $request->incident_id)->first(), $channel);

    }
    public function getIncidentModelViaKeys()
    {
        return [
            'hazards' => Hazard::class,
            'near_misses' => NearMiss::class,
            'unsafe_behaviors' => UnsafeBehavior::class,
            'injuries' => Injury::class,
            'fpdamages' => FirePropertyDamage::class,
        ];
    }
    public function store(Request $request, $incident, $channel = "web", $assignCount = 2)
    {
        $validator = Validator::make($request->all(), [
            'assign_by' => 'required|exists:users,id',
            'assign_to' => 'required|exists:users,id',
        ]);

        if (!$incident) {
            if ($channel == "api") {
                return ApiResponseController::error('Incident with given id not found');
            }
        }

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $incidentAssignedCollection = IncidentAssign::where('incident_id', $incident->id)->where('form_name', $incident->getTable())->get();

        // one user cannot be both assigner or assing to
        if ($request->assign_to == $request->assign_by) {
            if ($channel === 'api') {
                return ApiResponseController::error('Assign to and Assign by cannot be same');
            }
            return ['error', 'Assign to and assign by cannot be same'];
        }

        if (!$incidentAssignedCollection->count() == 0) {
            // A can assign to B only once B can assign to C
            if ($incidentAssignedCollection->last()->assign_to != $request->assign_by or $incidentAssignedCollection->where('assign_by', $request->assign_by)->count() > 1) {
                if ($channel === 'api') {
                    return ApiResponseController::error('You are not allowed to assign');
                }
                return ['error', 'You are not allowed to assign'];
            }

            // if A assign to B then B cannot assign back to A
            if ($incidentAssignedCollection->where('assign_by', $request->assign_to)->count() > 0) {
                if ($channel === 'api') {
                    return ApiResponseController::error('Cannot assign to predecessors assigner');
                }
                return ['error', 'cannot assign to predecessor'];
            }
            // should not allow to assign more than allowed assignement hierarchy limit
            if ($incidentAssignedCollection->last()->assign_count >= $assignCount) {
                if ($channel === 'api') {
                    return ApiResponseController::error('Cannot assign further as limit breached');
                }
                return ['error', 'Cannot assign further as limit breaced'];
            }


        }
        $incidentAssigned = new IncidentAssign();
        // if everything goes will then we shoul dbe able to prcess the data
        $incidentAssigned->assign_count += $incidentAssigned->assign_count;
        $incidentAssigned->incident_id = $incident->id;
        $incidentAssigned->form_name = $incident->getTable();
        $incidentAssigned->assign_by = $request->assign_by;
        $incidentAssigned->assign_to = $request->assign_to;
        $incidentAssigned->assign_count = $incidentAssignedCollection->last() ? $incidentAssignedCollection->last()->assign_count + 1 : 1;
        $incidentAssigned->allowed_assign = ($incidentAssigned->assign_count === $assignCount) ? 0 : 1;
        $incidentAssigned->save();
        $incident->meta_incident_status_id = MetaIncidentStatus::where('status_code', 1)->first()->id; //assigned
        $incident->save();


        if ($channel == 'api') {
            return ApiResponseController::success('Incident has been assigned');
        }

        return ['success', "Incident has been assigned", $request->redirect];
    }

    public function rejectIncidentByName($request, $channel = "web")
    {
        $validator = Validator::make($request->all(), [
            'incident_id' => 'required',
            'incident_name' => 'required',
        ]);


        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $incidentsModelsArray = $this->getIncidentModelViaKeys();
        $incident = $incidentsModelsArray[$request->incident_name]::where('id', $request->incident_id)->first();
        $incident->meta_incident_status_id = MetaIncidentStatus::where('status_code', 4)->first()->id; //rejected
        $incident->save();

        if ($channel == 'api') {
            return ApiResponseController::success('Incident has been rejected');
        }

        // return ['success', "Incident has been rejected", $request->redirect];

    }


    /**
     * Display the specified resource.
     */
    public function show(IncidentAssign $incidentAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncidentAssign $incidentAssign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $assign_id, $channel = 'web')
    {
        $validator = Validator::make($request->all(), [
            'assign_to' => 'required|exists:users,id',
        ]);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $incidentAssigned = IncidentAssign::where('id', $assign_id)->first();
        if (!$incidentAssigned) {
            if ($channel === 'api') {
                if ($channel === 'api') {
                    return ApiResponseController::error('Assigned Users Data not found', 404);
                }
            }
            return ['error', 'not found'];
        }

        $form_name = $incidentAssigned->form_name;
        $incident_id = $incidentAssigned->incident_id;
        $IncidentAllAssignedUsers = IncidentAssign::where('form_name', $form_name)->where('incident_id', $incident_id)->get();



        if ($IncidentAllAssignedUsers->count() > 1 && $IncidentAllAssignedUsers->last()->id != $assign_id) {
            if ($channel === "api") {
                return ApiResponseController::error('Cannot update as it is further assigned by assignee');
            }
            return ['error', 'Cannot update as it is further assigned by assignee'];
        }
        if ($IncidentAllAssignedUsers->count() === 1 && $IncidentAllAssignedUsers->last()->id === $assign_id) {
            $incidentAssigned = $IncidentAllAssignedUsers->last();
        }

        if ($incidentAssigned->assign_by == $request->assign_to) {
            if ($channel === 'api') {
                return ApiResponseController::error('Assign to and Assign by cannot be same');
            }
            return ['error', 'Assigner and Assignee cant be same person'];
        }
        if ($IncidentAllAssignedUsers->where('assign_by', $request->assign_to)->count() > 0) {
            if ($channel === 'api') {
                return ApiResponseController::error('Cannot assign to predecessor assigner');
            }
            return ['error', 'cannot assign to predecessor'];
        }


        $incidentAssigned->assign_to = $request->assign_to;
        $incidentAssigned->save();
        if ($channel === 'api') {
            return ApiResponseController::successWithData('Assigned Users updated', new IncidentAssignCollection($incidentAssigned));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncidentAssign $incidentAssign)
    {
        //
    }

    public function validateData(Request $request)
    {
        return
            Validator::make($request->all(), [
                'assign_by' => 'required|exists:users,id',
                'assign_to' => 'required|exists:users,id',
            ]);
    }

    public static function getAssignedIncidents($modelClass, $incident_name)
    {
        // admin can fetch all records
        if (auth()->user()->can(["{$incident_name}.index", "{$incident_name}.delete", "{$incident_name}.view", "{$incident_name}.edit", "{$incident_name}.create"])) {
            if (is_object($modelClass)) {
                // var_dump('its here');
                $modelCollection = $modelClass->orderby('id', 'desc');
            } else {
                $modelCollection = $modelClass::orderby('id', 'desc');
            }

        } else {
            if (is_object($modelClass)) {
                // if not admin then we have to fetch only assigned or initiated records.
                $modelCollection = $modelClass->WhereHas('assignedUsers', function ($query) {
                    $query->where('assign_by', auth()->user()->id)
                        ->orWhere('assign_to', auth()->user()->id);
                })
                    ->orWhere('initiated_by', auth()->user()->id)
                    ->orderby('id', 'desc');
            } else {
                // if not admin then we have to fetch only assigned or initiated records.
                $modelCollection = $modelClass::WhereHas('assignedUsers', function ($query) {
                    $query->where('assign_by', auth()->user()->id)
                        ->orWhere('assign_to', auth()->user()->id);
                })
                    ->orWhere('initiated_by', auth()->user()->id)
                    ->orderby('id', 'desc');
            }
        }
        return $modelCollection;
    }
}