<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UnsafeBehaviorCollection;
use App\Models\MetaDepartment;
use App\Models\MetaIncidentStatus;
use App\Models\MetaLine;
use App\Models\MetaLocation;
use App\Models\MetaRiskLevel;
use App\Models\MetaUnit;
use App\Models\MetaUnsafeBehaviorAction;
use App\Models\MetaUnsafeBehaviorType;
use App\Models\UnsafeBehavior;
use App\Rules\MetaLocationValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UnsafeBehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = 'web')
    {
        RolesPermissionController::can(['unsafe_behavior.index']);
        $unsafe_behavior = IncidentAssignController::getAssignedIncidents(UnsafeBehavior::class, 'unsafe_behavior');

        if ($channel === 'api') {
            return $unsafe_behavior;
        }

        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($unsafe_behavior->get() as $unsafe_behavior) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'unit' => $unsafe_behavior->unit->unit_title,
                    'department' => $unsafe_behavior->department->department_title,
                    'line' => $unsafe_behavior->line,
                    'location' => $unsafe_behavior->location,
                    'date' => $unsafe_behavior->date,
                    'incident_status' => $unsafe_behavior->incident_status->status_title,
                    'action' => view('unsafe-behavior.partials.action-buttons', ['unsafe_behavior' => $unsafe_behavior])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('unsafe-behavior.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['unsafe_behavior.create']);
        $departments = MetaDepartment::select('id', 'department_title')->get();
        $lines = MetaLine::select('id', 'line_title')->get();
        $ub_types = MetaUnsafeBehaviorType::select('id', 'unsafe_behavior_type_title')->get();
        $incident_statuses = MetaIncidentStatus::select('status_code', 'status_title', 'id')->get();
        $unsafe_behavior_actions = MetaUnsafeBehaviorAction::select('action_title', 'id')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $risk_levels = MetaRiskLevel::select('id', 'risk_level_title')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        return view('unsafe-behavior.create', compact('locations', 'risk_levels', 'units', 'departments', 'lines', 'ub_types', 'incident_statuses', 'unsafe_behavior_actions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = 'web')
    {
        $validator = $this->validateData($request);
        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        $unsafe_behavior = new UnsafeBehavior();
        $unsafe_behavior->date = $request->date;
        $unsafe_behavior->initiated_by = auth()->user()->id;
        $unsafe_behavior->meta_unit_id = $request->meta_unit_id;
        $unsafe_behavior->meta_department_id = $request->meta_department_id;
        // $unsafe_behavior->meta_line_id = $request->meta_line_id;
        $unsafe_behavior->meta_location_id = $request->meta_location_id;
        $unsafe_behavior->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id;
        $unsafe_behavior->details = $request->details;
        $unsafe_behavior->meta_risk_level_id = $request->meta_risk_level_id;
        $unsafe_behavior->action = $request->action;
        $unsafe_behavior->other_location = $request->other_location;
        $unsafe_behavior->line = $request->line;
        $unsafe_behavior->save();
        $unsafe_behavior->unsafe_behavior_types()->sync($request->unsafe_behavior_types);
        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $unsafe_behavior, 'initial_attachements');
        }
        if ($channel === 'api') {
            return ApiResponseController::successWithData('Unsafe Behavior Created.', new UnsafeBehaviorCollection($unsafe_behavior));
        }

        return ['success', 'Unsafe Behavior Created', $request->redirect];
    }

    /**
     * Display the specified resource.
     */
    public function show($unsafe_behavior_id, $channel = "web")
    {
        $unsafe_behavior = UnsafeBehavior::where('id', $unsafe_behavior_id);
        RolesPermissionController::canViewIncident($unsafe_behavior->first(), 'unsafe_behavior');
        if ($channel === 'api') {
            return $unsafe_behavior->first();
        }
        $unsafe_behavior = $unsafe_behavior->firstOrFail();
        return view('unsafe-behavior.show', compact('unsafe_behavior'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnsafeBehavior $unsafe_behavior)
    {
        RolesPermissionController::canEditIncident($unsafe_behavior, 'unsafe_behavior');
        $units = MetaUnit::select('id', 'unit_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();
        $lines = MetaLine::select('id', 'line_title')->get();
        $ub_types = MetaUnsafeBehaviorType::select('id', 'unsafe_behavior_type_title')->get();
        $incident_statuses = MetaIncidentStatus::select('status_code', 'status_title', 'id')->get();
        $unsafe_behavior_actions = MetaUnsafeBehaviorAction::select('action_title', 'id')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        $risk_levels = MetaRiskLevel::select('id', 'risk_level_title')->get();

        return view('unsafe-behavior.edit', compact('locations', 'risk_levels', 'units', 'departments', 'lines', 'ub_types', 'incident_statuses', 'unsafe_behavior', 'unsafe_behavior_actions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $unsafe_behavior_id, $channel = "web")
    {


        $validator = $this->validateData($request, 'update');

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        $unsafe_behavior = UnsafeBehavior::where('id', $unsafe_behavior_id)->first();
        // if allowed to update
        RolesPermissionController::canEditIncident($unsafe_behavior, 'unsafe_behavior');


        if (!$unsafe_behavior && $channel === 'api') {
            return ApiResponseController::error('Unsafe Behavior not found', 404);
        }

        // $unsafe_behavior->date = $request->date;
        // $unsafe_behavior->initiated_by = auth()->user()->id;
        $unsafe_behavior->meta_unit_id = $request->meta_unit_id ?? $unsafe_behavior->meta_unit_id;
        $unsafe_behavior->meta_department_id = $request->meta_department_id ?? $unsafe_behavior->meta_department_id;
        // $unsafe_behavior->meta_line_id = $request->meta_line_id ?? $unsafe_behavior->meta_line_id;
        $unsafe_behavior->meta_location_id = $request->meta_location_id ?? $unsafe_behavior->meta_location_id;
        $unsafe_behavior->meta_incident_status_id = $request->meta_incident_status_id ?? $unsafe_behavior->meta_incident_status_id;
        $unsafe_behavior->details = $request->details ?? $unsafe_behavior->details;
        // $unsafe_behavior->meta_unsafe_behavior_action_id = $request->meta_unsafe_behavior_action_id ?? $unsafe_behavior->meta_unsafe_behavior_action_id;
        $unsafe_behavior->meta_risk_level_id = $request->meta_risk_level_id ?? $unsafe_behavior->meta_risk_level_id;
        $unsafe_behavior->action = $request->action ?? $unsafe_behavior->action;
        $unsafe_behavior->other_location = $request->other_location ?? $unsafe_behavior->other_location;
        $unsafe_behavior->line = $request->line ?? $unsafe_behavior->line;
        $unsafe_behavior->save();

        $unsafe_behavior->save();
        $unsafe_behavior->unsafe_behavior_types()->sync($request->unsafe_behavior_types);

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $unsafe_behavior, 'attachements');
        }

        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $unsafe_behavior, 'initial_attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Unsafe Behavior Updated.', new UnsafeBehaviorCollection($unsafe_behavior));
        }

        return ['success', 'Unsafe Behavior has been updated', $request->redirect];





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($unsafe_behavior_id, $channel = "web")
    {
        RolesPermissionController::can(['unsafe_behavior.delete']);

        $unsafe_behavior = UnsafeBehavior::find($unsafe_behavior_id);
        if (!$unsafe_behavior && $channel === "api") {
            return ApiResponseController::error('Unsafe Behavior not found', 404);
        }

        if (!$unsafe_behavior) {
            return ['error', 'Unsafe Behavior not found'];
        }

        // deleting the Unsafe Behavior
        if ($unsafe_behavior->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Unsafe Behavior has been delete');
            } else {
                return ['deleted', 'Unsafe Behavior has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the Unsafe Behavior.');
            } else {
                return ['error', 'Could not delete the Unsafe Behavior'];
            }
        }
    }

    public function assign(Request $request, $unsafe_behavior_id, $channel = 'web')
    {
        $unsafe_behavior = UnsafeBehavior::where('id', $unsafe_behavior_id)->first();
        if ($unsafe_behavior) {
            return (new IncidentAssignController)->store($request, $unsafe_behavior, $channel);
        } else {
            return ApiResponseController::error('Unsafe Behavior not found.', 404);
        }
    }


    public function validateData(Request $request, $method = 'store')
    {
        $rules = [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'unsafe_behavior_types' => ['array', 'required'],
            'unsafe_behavior_types.*' => ['exists:meta_unsafe_behavior_types,id'],
            'meta_risk_level_id' => 'required|exists:meta_risk_levels,id',
            'initiated_by' => ['nullable', 'exists:users,id'],
            'meta_unit_id' => ['required', 'exists:meta_units,id'],
            'meta_location_id' => ['exists:meta_locations,id', new MetaLocationValidate],
            'meta_department_id' => ['required', 'exists:meta_departments,id'],
            // 'meta_unsafe_behavior_action_id' => ['nullable', 'exists:meta_unsafe_behavior_actions,id'],
            // 'meta_line_id' => ['required', 'exists:meta_lines,id'],
            'details' => ['nullable', 'string', 'max:255'],
            'other_location' => ['nullable', 'string', 'max:255'],
            'action' => ['nullable', 'string', 'max:255'],
            'line' => ['nullable', 'string', 'max:255'],
            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif,doc,docx,pdf,xlsx,csv|max:2048'],
            'initial_attachements' => ['array', 'nullable'],
            'initial_attachements.*' => ['mimes:jpeg,png,jpg,gif,doc,docx,pdf,xlsx,csv|max:2048'],
        ];

        if ($method == 'update') {
            $rules['meta_unit_id'] = 'nullable|exists:meta_units,id';
            $rules['meta_incident_status_id'] = ['required', 'exists:meta_incident_statuses,id'];
            $rules['meta_risk_level_id'] = ['nullable', 'exists:meta_risk_levels,id'];
        }
        return Validator::make($request->all(), $rules);
    }
}