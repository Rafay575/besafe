<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\NearMissCollection;
use App\Models\MetaDepartment;
use App\Models\MetaIncidentStatus;
use App\Models\MetaLine;
use App\Models\MetaLocation;
use App\Models\MetaNearMissClass;
use App\Models\MetaUnit;
use App\Models\NearMiss;
use App\Rules\MetaLocationValidate;
use App\Rules\MetaPersonValidate;
use App\Rules\NearMissActionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class NearMissController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['near_miss.index']);
        $near_misses = IncidentAssignController::getAssignedIncidents(NearMiss::class, 'near_miss');
        if ($channel === 'api') {
            return $near_misses;
        }

        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($near_misses->get() as $near_miss) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'date' => formatDate($near_miss->date),
                    'time' => $near_miss->time,
                    'immediate_action' => $near_miss->immediate_action,
                    'employee_name' => implode(", ", collect($near_miss->persons)->pluck('name')->toArray()),
                    'location' => $near_miss->meta_location ? $near_miss->meta_location->location_title : '',
                    'unit' => $near_miss->unit ? $near_miss->unit->unit_title : '',
                    'near_miss_class' => $near_miss->near_miss_class ? $near_miss->near_miss_class->class_title : '',
                    'incident_status' => $near_miss->incident_status->status_title,
                    'action' => view('near-miss.partials.action-buttons', ['near_miss' => $near_miss])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('near-miss.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['near_miss.create']);
        $incident_statuses = MetaIncidentStatus::select('id', 'status_title')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();
        $lines = MetaLine::select('id', 'line_title')->get();
        $near_miss_classes = MetaNearMissClass::select('id', 'class_title')->get();

        return view('near-miss.create', compact('lines', 'near_miss_classes', 'incident_statuses', 'units', 'locations', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = 'web')
    {
        RolesPermissionController::can(['near_miss.create']);
        $validator = $this->validateData($request);
        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }
        // Create a new NearMiss instance
        $near_miss = new NearMiss();

        // Assign values from the request data to the model attributes
        $near_miss->date = $request->date;
        $near_miss->time = $request->time;
        $near_miss->initiated_by = auth()->user()->id;
        $near_miss->location = $request->location;
        $near_miss->description = $request->description;
        $near_miss->immediate_action = $request->immediate_action;
        $near_miss->meta_unit_id = $request->meta_unit_id;
        $near_miss->meta_location_id = $request->meta_location_id;
        $near_miss->immediate_cause = $request->immediate_cause;
        $near_miss->root_cause = $request->root_cause;
        $near_miss->actions = $request->actions;
        $near_miss->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id; //pending
        $near_miss->other_location = $request->other_location;
        $near_miss->person_involved = $request->person_involved;
        $near_miss->shift = $request->shift;
        $near_miss->witness_name = $request->witness_name;
        $near_miss->initial_recommendation = $request->initial_recommendation;
        $near_miss->meta_department_id = $request->meta_department_id;
        $near_miss->meta_near_miss_class_id = $request->meta_near_miss_class_id;
        $near_miss->persons = $request->persons;
        $near_miss->line = $request->line;
        // Save the model to create a new record
        $near_miss->save();

        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $near_miss, 'initial_attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Near Miss created.', new NearMissCollection($near_miss));
        }

        return ['success', 'Near miss has been creaetd', $request->redirect];


    }

    /**
     * Display the specified resource.
     */
    public function show($near_miss_id, $channel = "web")
    {
        $near_miss = NearMiss::where('id', $near_miss_id);
        RolesPermissionController::canViewIncident($near_miss->first(), 'near_miss');
        if ($channel === 'api') {
            return $near_miss->first();
        }
        $near_miss = $near_miss->firstOrFail();
        return view('near-miss.show', compact('near_miss'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NearMiss $near_miss)
    {
        RolesPermissionController::can(['near_miss.edit']);
        $incident_statuses = MetaIncidentStatus::select('status_code', 'status_title', 'id')->whereNot('status_code', 0)->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();
        $lines = MetaLine::select('id', 'line_title')->get();
        $near_miss_classes = MetaNearMissClass::select('id', 'class_title')->get();
        return view('near-miss.edit', compact('near_miss_classes', 'incident_statuses', 'near_miss', 'units', 'locations', 'departments', 'lines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $near_miss_id, $channel = "web")
    {

        $validator = $this->validateData($request, 'update');

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $near_miss = NearMiss::where('id', $near_miss_id)->first();
        if (!$near_miss && $channel === 'api') {
            return ApiResponseController::error('Near Miss not found', 404);
        }
        // if allowed to update
        RolesPermissionController::canEditIncident($near_miss, 'near_miss');

        if ($request->has('date') && !empty($request->date)) {
            $near_miss->date = $request->date;
        }

        if ($request->has('time') && !empty($request->time)) {
            $near_miss->time = $request->time;
        }

        if ($request->has('location') && !empty($request->location)) {
            $near_miss->location = $request->location;
        }

        if ($request->has('description') && !empty($request->description)) {
            $near_miss->description = $request->description;
        }

        if ($request->has('immediate_action') && !empty($request->immediate_action)) {
            $near_miss->immediate_action = $request->immediate_action;
        }

        if ($request->has('immediate_cause') && !empty($request->immediate_cause)) {
            $near_miss->immediate_cause = $request->immediate_cause;
        }

        if ($request->has('root_cause') && !empty($request->root_cause)) {
            $near_miss->root_cause = $request->root_cause;
        }

        if ($request->has('actions') && !empty($request->actions)) {
            $near_miss->actions = $request->actions;
        }
        if ($request->has('meta_unit_id') && !empty($request->meta_unit_id)) {
            $near_miss->meta_unit_id = $request->meta_unit_id;
            $near_miss->meta_location_id = $request->meta_location_id;
        }

        if ($request->has('meta_incident_status_id') && !empty($request->meta_incident_status_id)) {
            $near_miss->meta_incident_status_id = $request->meta_incident_status_id;
        }
        $near_miss->other_location = $request->other_location ?? $near_miss->other_location;
        $near_miss->person_involved = $request->person_involved ?? $near_miss->person_involved;
        $near_miss->shift = $request->shift ?? $near_miss->shift;
        $near_miss->witness_name = $request->witness_name ?? $near_miss->witness_name;
        $near_miss->initial_recommendation = $request->initial_recommendation ?? $near_miss->initial_recommendation;
        $near_miss->meta_department_id = $request->meta_department_id ?? $near_miss->meta_department_id;
        $near_miss->meta_near_miss_class_id = $request->meta_near_miss_class_id ?? $near_miss->meta_near_miss_class_id;
        $near_miss->persons = $request->persons ?? $near_miss->persons;
        $near_miss->line = $request->line ?? $near_miss->line;

        $near_miss->save();


        // Save the model to create a new record
        $near_miss->save();

        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $near_miss, 'initial_attachements');
        }

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $near_miss, 'attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Near Miss updated.', new NearMissCollection($near_miss));
        }

        return ['success', 'Near miss updated', $request->redirect];


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($near_miss_id, $channel = 'web')
    {
        RolesPermissionController::can(['near_miss.delete']);

        $near_miss = NearMiss::find($near_miss_id);
        if (!$near_miss && $channel === "api") {
            return ApiResponseController::error('Near Miss not found', 404);
        }

        if (!$near_miss) {
            return ['error', 'Near Miss not found'];
        }

        // deleting the near_miss
        if ($near_miss->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Near miss has been delete');
            } else {
                return ['deleted', 'Near miss has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the Near Miss.');
            } else {
                return ['error', 'Could not delete the Near Miss'];
            }
        }
    }

    public function assign(Request $request, $near_miss_id, $channel = 'web')
    {
        $near_miss = NearMiss::where('id', $near_miss_id)->first();
        if ($near_miss) {
            return (new IncidentAssignController)->store($request, $near_miss, $channel);
        } else {
            return ApiResponseController::error('Near Miss not found.', 404);
        }
    }

    public function validateData(Request $request, $method = "store")
    {
        $rules = [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'time' => ['required', 'date_format:H:i'],
            'meta_unit_id' => 'required|exists:meta_units,id',
            'meta_line_id' => 'nullable|exists:meta_lines,id',
            'meta_location_id' => ['exists:meta_locations,id', new MetaLocationValidate],
            // 'location' => ['nullable', 'string'],

            'other_location' => ['nullable', 'string'],
            'line' => ['nullable', 'string'],
            'person_involved' => ['in:1,0'],
            'shift' => ['nullable', 'string'],
            'witness_name' => ['nullable', 'string'],
            'initial_recommendation' => ['nullable', 'string'],
            'meta_department_id' => 'required|exists:meta_departments,id',
            'meta_near_miss_class_id' => 'nullable|exists:meta_near_miss_classes,id',
            'persons' => ['array', new MetaPersonValidate],



            'description' => ['nullable', 'string'],
            'immediate_action' => ['nullable', 'string'],
            'immediate_cause' => ['nullable', 'string'],
            'root_cause' => ['nullable', 'string'],
            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif,pdf,doc,docx,xlsx,csv|max:2048'],
            'initial_attachements' => ['array', 'nullable'],
            'initial_attachements.*' => ['mimes:jpeg,png,jpg,gif,pdf,doc,docx,xlsx,csv|max:2048'],
            'actions' => ['array', new NearMissActionData],

        ];
        if ($method == 'update') {
            $rules['date'] = ['nullable', 'date', 'date_format:Y-m-d'];
            $rules['time'] = ['nullable', 'date_format:H:i'];
            $rules['meta_incident_status_id'] = ['required', 'exists:meta_incident_statuses,id'];
            $rules['meta_unit_id'] = 'nullable|exists:meta_units,id';
            $rules['meta_department_id'] = 'nullable|exists:meta_departments,id';
        }
        return
            Validator::make($request->all(), $rules, );

    }
}