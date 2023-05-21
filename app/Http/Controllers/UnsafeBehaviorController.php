<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\UnsafeBehaviorCollection;
use App\Models\MetaIncidentStatus;
use App\Models\UnsafeBehavior;
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
                    'line' => $unsafe_behavior->line->line_title,
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

        return view('unsafe-behavior.create');
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
        $unsafe_behavior->meta_line_id = $request->meta_line_id;
        $unsafe_behavior->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id;
        $unsafe_behavior->details = $request->details;
        $unsafe_behavior->save();
        $unsafe_behavior->unsafe_behavior_types()->sync($request->unsafe_behavior_types);
        if ($request->hasFile('attachments')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $unsafe_behavior, 'attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Unsafe Behavior Created.', new UnsafeBehaviorCollection($unsafe_behavior));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($unsafe_behavior_id, $channel = "web")
    {
        $unsafe_behavior = UnsafeBehavior::where('id', $unsafe_behavior_id)->first();
        RolesPermissionController::canViewIncident($unsafe_behavior, 'unsafe_behavior');
        if ($channel === 'api') {
            return $unsafe_behavior;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnsafeBehavior $unsafeBehavior)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $unsafe_behavior_id, $channel = "web")
    {
        $validator = $this->validateData($request);

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
        $unsafe_behavior->meta_unit_id = $request->meta_unit_id;
        $unsafe_behavior->meta_department_id = $request->meta_department_id;
        $unsafe_behavior->meta_line_id = $request->meta_line_id;
        $unsafe_behavior->meta_incident_status_id = $request->meta_incident_status_id;
        $unsafe_behavior->details = $request->details;
        $unsafe_behavior->save();
        $unsafe_behavior->unsafe_behavior_types()->sync($request->unsafe_behavior_types);

        if ($request->hasFile('attachments')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $unsafe_behavior, 'attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Unsafe Behavior Updated.', new UnsafeBehaviorCollection($unsafe_behavior));
        }




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


    public function validateData(Request $request)
    {
        return
            Validator::make($request->all(), [
                'date' => ['required', 'date', 'date_format:Y-m-d'],
                'unsafe_behavior_types' => ['array', 'required'],
                'unsafe_behavior_types.*' => ['exists:meta_unsafe_behavior_types,id'],
                'initiated_by' => ['nullable', 'exists:users,id'],
                'meta_unit_id' => ['required', 'exists:meta_units,id'],
                'meta_department_id' => ['required', 'exists:meta_departments,id'],
                'meta_line_id' => ['required', 'exists:meta_lines,id'],
                'meta_incident_status_id' => ['required', 'exists:meta_incident_statuses,id'],
                'details' => ['nullable', 'string'],
                'attachements' => ['array', 'nullable'],
                'attachements.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],
            ]);
    }
}