<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\Api\NearMissCollection;
use App\Models\MetaIncidentStatus;
use App\Models\NearMiss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NearMissController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($channel = "web")
    {
        RolesPermissionController::can(['near_miss.index']);
        $near_misses = IncidentAssignController::getAssignedIncidents(NearMiss::class, 'near_miss');
        if ($channel === 'api') {
            return $near_misses;
        }
        return view('near-miss.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['near_miss.create']);

        return view('near-miss.create');
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
        $near_miss->immediate_cause = $request->immediate_cause;
        $near_miss->root_cause = $request->root_cause;
        $near_miss->actions = $request->actions;
        $near_miss->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id; //pending
        // Save the model to create a new record
        $near_miss->save();

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $near_miss, 'attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Near Miss created.', new NearMissCollection($near_miss));
        }



    }

    /**
     * Display the specified resource.
     */
    public function show($near_miss_id, $channel = "web")
    {
        $near_miss = NearMiss::where('id', $near_miss_id)->first();
        RolesPermissionController::canViewIncident($near_miss, 'near_miss');
        if ($channel === 'api') {
            return $near_miss;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NearMiss $nearMiss)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $near_miss_id, $channel = "web")
    {

        $validator = $this->validateData($request);

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

        $near_miss->date = $request->date;
        $near_miss->time = $request->time;
        $near_miss->initiated_by = auth()->user()->id;
        $near_miss->location = $request->location;
        $near_miss->description = $request->description;
        $near_miss->immediate_action = $request->immediate_action;
        $near_miss->immediate_cause = $request->immediate_cause;
        $near_miss->root_cause = $request->root_cause;
        $near_miss->actions = $request->actions;
        $near_miss->meta_incident_status_id = $request->meta_incident_status_id;

        // Save the model to create a new record
        $near_miss->save();

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $near_miss, 'attachements');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Near Miss updated.', new NearMissCollection($near_miss));
        }




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
            return ['error', 'near_miss not found'];
        }

        // deleting the near_miss
        if ($near_miss->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Near miss has been delete');
            } else {
                return ['success', 'Near miss has been deleted'];
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

    public function validateData(Request $request)
    {
        return
            Validator::make($request->all(), [
                'date' => ['required', 'date'],
                'time' => ['required', 'date_format:H:i'],
                'location' => ['nullable', 'string'],
                'description' => ['nullable', 'string'],
                'immediate_action' => ['nullable', 'string'],
                'immediate_cause' => ['nullable', 'string'],
                'root_cause' => ['nullable', 'string'],
                'meta_incident_status_id' => ['required', 'exists:meta_incident_statuses,id'],
                'attachements' => ['array', 'nullable'],
                'attachements.*' => ['required,file,mimes:jpeg,png,pdf,doc,docx'],
                'actions' => 'nullable|array',
                'actions.*.action' => 'required|string',
                'actions.*.responsible' => 'required|string',
                'actions.*.target_date' => 'required|date_format:Y-m-d',
                'actions.*.remarks' => 'required|string',
            ]);
    }
}