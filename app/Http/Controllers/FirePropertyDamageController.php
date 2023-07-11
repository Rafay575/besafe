<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\FirePropertyDamageCollection;
use App\Models\FirePropertyDamage;
use App\Models\MetaDepartment;
use App\Models\MetaFireCategory;
use App\Models\MetaIncidentStatus;
use App\Models\MetaPropertyDamage;
use App\Models\MetaUnit;
use App\Rules\FirePropertyActionData;
use App\Rules\TotalLossCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class FirePropertyDamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['fire_property_damage.index']);
        $fpdamages = IncidentAssignController::getAssignedIncidents(FirePropertyDamage::class, 'fire_property_damage');
        if ($channel === 'api') {
            return $fpdamages;
        }


        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($fpdamages->get() as $fpdamage) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'date' => $fpdamage->date,
                    'reference' => $fpdamage->reference,
                    'unit' => $fpdamage->unit->unit_title,
                    'location' => $fpdamage->location,
                    'incident_status' => $fpdamage->incident_status->status_title,
                    'action' => view('fire-property.partials.action-buttons', ['fpdamage' => $fpdamage])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('fire-property.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['fire_property_damage.create']);
        $incident_statuses = MetaIncidentStatus::select('id', 'status_title')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $property_damages = MetaPropertyDamage::select('id', 'property_damage_title')->get();
        $fire_categories = MetaFireCategory::select('id', 'fire_category_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();
        return view('fire-property.create', compact('incident_statuses', 'units', 'property_damages', 'departments', 'fire_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = 'web')
    {
        RolesPermissionController::can(['fire_property_damage.create']);

        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $fpdamage = new FirePropertyDamage();
        $fpdamage->date = $request->date;
        $fpdamage->initiated_by = auth()->user()->id;
        $fpdamage->reference = $request->reference;
        $fpdamage->meta_unit_id = $request->meta_unit_id ?? null;
        $fpdamage->location = $request->location;
        $fpdamage->meta_fire_category_id = $request->meta_fire_category_id ?? null;
        $fpdamage->meta_property_damage_id = $request->meta_property_damage_id ?? null;
        $fpdamage->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id; //pending
        $fpdamage->description = $request->description;
        $fpdamage->immediate_action = $request->immediate_action;
        $fpdamage->immediate_cause = $request->immediate_cause;
        $fpdamage->root_cause = $request->root_cause;
        $fpdamage->similar_incident_before = $request->similar_incident_before;
        $fpdamage->loss_calculation = $request->loss_calculation; //json
        $fpdamage->loss_recovery_method = $request->loss_recovery_method;
        $fpdamage->preventative_measure = $request->preventative_measure;
        $fpdamage->actions = $request->actions; //json
        $fpdamage->save();

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $fpdamage, 'attachements');
        }

        if ($request->has('interview_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->interview_attachs, $fpdamage, 'interview_attachs');
        }
        if ($request->has('record_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->record_attachs, $fpdamage, 'record_attachs');
        }
        if ($request->has('photograph_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->photograph_attachs, $fpdamage, 'photograph_attachs');
        }

        if ($request->has('other_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->other_attachs, $fpdamage, 'other_attachs');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Fire Property and damage created.', new FirePropertyDamageCollection($fpdamage));
        }

        return ['success', 'Fire property damage created', $request->redirect];

    }

    /**
     * Display the specified resource.
     */
    public function show($fpdamage_id, $channel = "web")
    {
        $fpdamage = FirePropertyDamage::where('id', $fpdamage_id);
        RolesPermissionController::canViewIncident($fpdamage->first(), 'fire_property_damage');
        if ($channel === 'api') {
            return $fpdamage->first();
        }
        $fire_property = $fpdamage->firstOrfail();
        return view('fire-property.show', compact('fire_property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FirePropertyDamage $fire_property)
    {
        RolesPermissionController::canEditIncident($fire_property, 'fire_property_damage');
        $incident_statuses = MetaIncidentStatus::select('id', 'status_title')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $fire_categories = MetaFireCategory::select('id', 'fire_category_title')->get();
        $property_damages = MetaPropertyDamage::select('id', 'property_damage_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();

        return view('fire-property.edit', compact('fire_property', 'incident_statuses', 'units', 'property_damages', 'departments', 'fire_categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fpdamage_id, $channel = "web")
    {

        $validator = $this->validateData($request, 'update');

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $fpdamage = FirePropertyDamage::where('id', $fpdamage_id)->first();

        // if allowed to update
        RolesPermissionController::canEditIncident($fpdamage, 'fire_property_damage');

        if (!$fpdamage && $channel === 'api') {
            return ApiResponseController::error('Fire Property damage not found', 404);
        }

        // $fpdamage->date = $request->date;
        // $fpdamage->initiated_by = auth()->user()->id;
        $fpdamage->reference = $request->has('reference') ? $request->reference : $fpdamage->reference;
        $fpdamage->meta_unit_id = $request->has('meta_unit_id') ? $request->meta_unit_id : $fpdamage->meta_unit_id;
        $fpdamage->location = $request->has('location') ? $request->location : $fpdamage->location;
        $fpdamage->meta_fire_category_id = $request->has('meta_fire_category_id') ? $request->meta_fire_category_id : $fpdamage->meta_fire_category_id;
        $fpdamage->meta_property_damage_id = $request->has('meta_property_damage_id') ? $request->meta_property_damage_id : $fpdamage->meta_property_damage_id;
        $fpdamage->meta_incident_status_id = $request->has('meta_incident_status_id') ? $request->meta_incident_status_id : $fpdamage->meta_incident_status_id;
        $fpdamage->description = $request->has('description') ? $request->description : $fpdamage->description;
        $fpdamage->immediate_action = $request->has('immediate_action') ? $request->immediate_action : $fpdamage->immediate_action;
        $fpdamage->immediate_cause = $request->has('immediate_cause') ? $request->immediate_cause : $fpdamage->immediate_cause;
        $fpdamage->root_cause = $request->has('root_cause') ? $request->root_cause : $fpdamage->root_cause;
        $fpdamage->similar_incident_before = $request->has('similar_incident_before') ? $request->similar_incident_before : $fpdamage->similar_incident_before;
        $fpdamage->loss_calculation = $request->has('loss_calculation') ? $request->loss_calculation : $fpdamage->loss_calculation;
        $fpdamage->loss_recovery_method = $request->has('loss_recovery_method') ? $request->loss_recovery_method : $fpdamage->loss_recovery_method;
        $fpdamage->preventative_measure = $request->has('preventative_measure') ? $request->preventative_measure : $fpdamage->preventative_measure;
        $fpdamage->actions = $request->has('actions') ? $request->actions : $fpdamage->actions;

        $fpdamage->save();


        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $fpdamage, 'attachements');
        }



        if ($request->has('interview_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->interview_attachs, $fpdamage, 'interview_attachs');
        }
        if ($request->has('record_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->record_attachs, $fpdamage, 'record_attachs');
        }
        if ($request->has('photograph_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->photograph_attachs, $fpdamage, 'photograph_attachs');
        }

        if ($request->has('other_attachs')) {
            (new CommonAttachementController)->syncUploadedArray($request->other_attachs, $fpdamage, 'other_attachs');
        }

        if ($channel === 'api') {
            return ApiResponseController::successWithData('Fire Property and damage updated.', new FirePropertyDamageCollection($fpdamage));
        }

        return ['success', 'Fire property damage has been updated', $request->redirect];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fpdamage_id, $channel = 'web')
    {
        RolesPermissionController::can(['fire_property_damage.delete']);

        $fpdamage = FirePropertyDamage::find($fpdamage_id);
        if (!$fpdamage && $channel === "api") {
            return ApiResponseController::error('Fire Property damage not found', 404);
        }

        if (!$fpdamage) {
            return ['error', 'Fire Property damage not found'];
        }

        // deleting the Fire Property damage
        if ($fpdamage->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Fire Property damage has been delete');
            } else {
                return ['deleted', 'Fire Property damage has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the Fire Property damage.');
            } else {
                return ['error', 'Could not delete the Fire Property damage'];
            }
        }
    }

    public function assign(Request $request, $fpdamage_id, $channel = 'web')
    {
        $fpdamage = FirePropertyDamage::where('id', $fpdamage_id)->first();
        if ($fpdamage) {
            return (new IncidentAssignController)->store($request, $fpdamage, $channel);
        } else {
            return ApiResponseController::error('Fire Property damage not found.', 404);
        }
    }

    public function validateData(Request $request, $method = 'store')
    {
        $rules = [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'meta_unit_id' => ['required', 'exists:meta_units,id'],
            'meta_fire_category_id' => ['required_without:meta_property_damage_id'],
            'meta_property_damage_id' => ['required_without:meta_fire_category_id'],
            'meta_incident_status_id' => ['required', 'exists:meta_incident_statuses,id'],
            'actions' => ['array', new FirePropertyActionData],
            'location' => ['nullable', 'string'],
            'reference' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'immediate_action' => ['nullable', 'string'],
            'immediate_cause' => ['nullable', 'string'],
            'root_cause' => ['nullable', 'string'],
            'similar_incident_before' => ['nullable', 'string'],
            'loss_recovery_method' => ['nullable', 'string'],
            'preventative_measure' => ['nullable', 'string'],
            'loss_calculation' => ['array', 'required', 'size:3'],
            'loss_calculation.direct_loss' => ['required', 'array'],
            'loss_calculation.direct_loss.description' => ['required', 'string'],
            'loss_calculation.direct_loss.value' => ['required', 'numeric'],
            'loss_calculation.indirect_loss' => ['required', 'array'],
            'loss_calculation.total_loss' => ['required', 'numeric', new TotalLossCalculation],
            'loss_calculation.indirect_loss.description' => ['required', 'string'],
            'loss_calculation.indirect_loss.value' => ['required', 'numeric'],

            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

            'initial_attachs' => ['array', 'nullable'],
            'initial_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

            'interview_attachs' => ['array', 'nullable'],
            'interview_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

            'record_attachs' => ['array', 'nullable'],
            'record_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

            'photograph_attachs' => ['array', 'nullable'],
            'photograph_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

            'other_attachs' => ['array', 'nullable'],
            'other_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],
        ];
        if ($request->has('meta_fire_category_id') && $request->meta_fire_category_id != "") {
            $rules['meta_fire_category_id'][0] = 'exists:meta_fire_categories,id';
        }
        if ($request->has('meta_property_damage_id') && $request->meta_property_damage_id != "") {
            $rules['meta_property_damage_id'][0] = 'exists:meta_property_damages,id';
        }
        if ($method === 'update') {
            // Update method rules
            $rules['date'] = ['nullable', 'date', 'date_format:Y-m-d'];
            $rules['meta_unit_id'] = ['nullable', 'exists:meta_units,id'];
            $rules['meta_incident_status_id'] = ['exists:meta_incident_statuses,id'];

            if ($request->has('loss_calculation')) {
                $rules['loss_calculation'] = ['array', 'required', 'size:3'];
                $rules['loss_calculation.direct_loss'] = ['required', 'array'];
                $rules['loss_calculation.direct_loss.description'] = ['required', 'string'];
                $rules['loss_calculation.direct_loss.value'] = ['required', 'numeric'];
                $rules['loss_calculation.indirect_loss'] = ['required', 'array'];
                $rules['loss_calculation.total_loss'] = ['required', 'numeric', new TotalLossCalculation];
                $rules['loss_calculation.indirect_loss.description'] = ['required', 'string'];
                $rules['loss_calculation.indirect_loss.value'] = ['required', 'numeric'];
            } else {
                unset($rules['loss_calculation']);
                unset($rules['loss_calculation.direct_loss']);
                unset($rules['loss_calculation.direct_loss.description']);
                unset($rules['loss_calculation.direct_loss.value']);
                unset($rules['loss_calculation.indirect_loss']);
                unset($rules['loss_calculation.total_loss']);
                unset($rules['loss_calculation.indirect_loss.description']);
                unset($rules['loss_calculation.indirect_loss.value']);
            }
        }

        return Validator::make($request->all(), $rules);
    }
}