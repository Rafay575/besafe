<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Resources\InjuryCollection;
use App\Models\Injury;
use App\Models\MetaBasicCause;
use App\Models\MetaContactType;
use App\Models\MetaDepartment;
use App\Models\MetaImmediateCause;
use App\Models\MetaIncidentCategory;
use App\Models\MetaIncidentStatus;
use App\Models\MetaInjuryCategory;
use App\Models\MetaLocation;
use App\Models\MetaRootCause;
use App\Models\MetaSgflRelation;
use App\Models\MetaUnit;
use App\Rules\InjuryActionData;
use App\Rules\MetaLocationValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class InjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $channel = "web")
    {
        RolesPermissionController::can(['injury.index']);
        $injuries = IncidentAssignController::getAssignedIncidents(Injury::class, 'injury');
        if ($channel === 'api') {
            return $injuries;
        }

        if ($request->ajax()) {
            $data = [];
            $i = 0;
            foreach ($injuries->get() as $injury) {
                $i++;
                $data[] = [
                    'sno' => $i,
                    'date' => $injury->date,
                    'time' => $injury->time,
                    'employee_involved' => $injury->employee_involved,
                    'injured_person' => $injury->injured_person,
                    // 'sgfl_relation' => $injury->meta_sgfl_relation_id ? $injury->msgfl_relation->sgfl_relation_title : '',
                    'incident_category' => $injury->incident_category->incident_category_title,
                    'injury_category' => $injury->injury_category->injury_category_title,
                    'incident_status' => $injury->incident_status->status_title,
                    'action' => view('injuries.partials.action-buttons', ['injury' => $injury])->render()
                ];
            }

            return DataTables::of($data)->toJson();
        }
        return view('injuries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        RolesPermissionController::can(['injury.create']);
        $incident_categories = MetaIncidentCategory::select('id', 'incident_category_title')->get();
        $injury_categories = MetaInjuryCategory::select('id', 'injury_category_title')->get();
        $incident_statuses = MetaIncidentStatus::select('status_code', 'status_title', 'id')->get();
        $sgfl_relations = MetaSgflRelation::select('id', 'sgfl_relation_title')->get();
        $immediate_causes = MetaImmediateCause::select('id', 'cause_title')->get();
        $basic_causes = MetaBasicCause::select('id', 'cause_title')->get();
        $root_causes = MetaRootCause::select('id', 'cause_title')->get();
        $contacts = MetaContactType::select('id', 'type_title')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();

        return view('injuries.create', compact('departments', 'units', 'locations', 'incident_categories', 'injury_categories', 'incident_statuses', 'sgfl_relations', 'immediate_causes', 'basic_causes', 'root_causes', 'contacts'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $channel = 'web')
    {
        RolesPermissionController::can(['injury.create']);



        $validator = $this->validateData($request);

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $injury = new Injury();
        $injury->initiated_by = auth()->user()->id;
        $injury->meta_injury_category_id = $request->meta_injury_category_id;
        $injury->meta_incident_category_id = $request->meta_incident_category_id;
        $injury->meta_incident_status_id = MetaIncidentStatus::where('status_code', 0)->first()->id; //pending
        $injury->employee_involved = $request->employee_involved;
        $injury->meta_sgfl_relation_id = $request->meta_sgfl_relation_id;
        $injury->witness_name = $request->witness_name;
        $injury->sgfl_relation = $request->sgfl_relation;
        $injury->details = $request->details;
        $injury->date = $request->date;
        $injury->immediate_action = $request->immediate_action;
        $injury->meta_unit_id = $request->meta_unit_id;
        $injury->meta_location_id = $request->meta_location_id;
        $injury->key_finding = $request->key_finding;
        $injury->actions = $request->actions; //json
        $injury->key_finding = $request->key_finding;

        $injury->other_location = $request->other_location;
        $injury->meta_department_id = $request->meta_department_id;
        $injury->line = $request->line;
        $injury->injured_person = $request->injured_person;
        $injury->time = $request->time;
        $injury->root_cause = $request->root_cause ?? $injury->root_cause;
        $injury->reference = self::getNextRef();

        try {
            //code...
            $injury->save();

        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }



        $injury->immediate_causes()->sync($request->meta_immediate_causes);
        // $injury->root_causes()->sync($request->meta_root_causes);
        // $injury->basic_causes()->sync($request->meta_basic_causes);
        $injury->contacts()->sync($request->meta_contact_types);


        // attachements

        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $injury, 'initial_attachements');
        }


        // if ($request->has('interview_attachs')) {
        //     (new CommonAttachementController)->syncUploadedArray($request->interview_attachs, $injury, 'interview_attachs');
        // }


        if ($channel === 'api') {
            return ApiResponseController::successWithData('Injury created.', new InjuryCollection($injury));
        }

        return ['success', 'Injury has been created', $request->redirect];

    }

    /**
     * Display the specified resource.
     */
    public function show($injury_id, $channel = "web")
    {
        $injury = Injury::where('id', $injury_id)->first();
        RolesPermissionController::canViewIncident($injury, 'injury');
        if ($channel === 'api') {
            return $injury;
        }
        return view('injuries.show', compact('injury'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Injury $injury)
    {
        $incident_categories = MetaIncidentCategory::select('id', 'incident_category_title')->get();
        $injury_categories = MetaInjuryCategory::select('id', 'injury_category_title')->get();
        $incident_statuses = MetaIncidentStatus::select('status_code', 'status_title', 'id')->whereNot('status_code', 0)->get();
        $sgfl_relations = MetaSgflRelation::select('id', 'sgfl_relation_title')->get();
        $immediate_causes = MetaImmediateCause::select('id', 'cause_title')->get();
        $basic_causes = MetaBasicCause::select('id', 'cause_title')->get();
        $root_causes = MetaRootCause::select('id', 'cause_title')->get();
        $contacts = MetaContactType::select('id', 'type_title')->get();
        $units = MetaUnit::select('id', 'unit_title')->get();
        $locations = MetaLocation::select('id', 'meta_unit_id', 'location_title')->get();
        $departments = MetaDepartment::select('id', 'department_title')->get();

        return view('injuries.edit', compact('departments', 'units', 'locations', 'injury', 'incident_categories', 'injury_categories', 'incident_statuses', 'sgfl_relations', 'immediate_causes', 'basic_causes', 'root_causes', 'contacts'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $injury_id, $channel = "web")
    {

        $validator = $this->validateData($request, 'update');

        $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
        if ($formErrorsResponse) {
            return $formErrorsResponse;
        }

        $injury = Injury::where('id', $injury_id)->first();

        // if allowed to update
        RolesPermissionController::canEditIncident($injury, 'injury');

        if (!$injury && $channel === 'api') {
            return ApiResponseController::error('Injury not found', 404);
        }

        $injury->meta_injury_category_id = $request->meta_injury_category_id ?? $injury->meta_injury_category_id;
        $injury->meta_incident_category_id = $request->meta_incident_category_id ?? $injury->meta_incident_category_id;
        $injury->meta_incident_status_id = $request->meta_incident_status_id ?? $injury->meta_incident_status_id;
        $injury->employee_involved = $request->employee_involved ?? $injury->employee_involved;
        $injury->witness_name = $request->witness_name ?? $injury->witness_name;
        // $injury->meta_sgfl_relation_id = $request->meta_sgfl_relation_id ?? $injury->meta_sgfl_relation_id;
        $injury->details = $request->details ?? $injury->details;
        $injury->date = $request->date ?? $injury->date;
        $injury->immediate_action = $request->immediate_action ?? $injury->immediate_action;
        $injury->meta_location_id = $request->meta_location_id ?? $injury->meta_location_id;
        $injury->meta_unit_id = $request->meta_unit_id ?? $injury->meta_unit_id;
        $injury->key_finding = $request->key_finding ?? $injury->key_finding;
        $injury->actions = $request->actions ?? $injury->actions; //json

        $injury->other_location = $request->other_location ?? $injury->other_location;
        $injury->meta_department_id = $request->meta_department_id ?? $injury->meta_department_id;
        $injury->line = $request->line ?? $injury->line;
        $injury->injured_person = $request->injured_person ?? $injury->injured_person;
        $injury->time = $request->time ?? $injury->time;
        $injury->root_cause = $request->root_cause ?? $injury->root_cause;


        $injury->save();

        // pivot data
        $injury->immediate_causes()->sync($request->meta_immediate_causes);
        // $injury->root_causes()->sync($request->meta_root_causes);
        $injury->basic_causes()->sync($request->meta_basic_causes);
        $injury->contacts()->sync($request->meta_contact_types);


        // attachements

        if ($request->has('attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->attachements, $injury, 'attachements');
        }
        if ($request->has('initial_attachements')) {
            (new CommonAttachementController)->syncUploadedArray($request->initial_attachements, $injury, 'initial_attachements');
        }

        // if ($request->has('interview_attachs')) {
        //     (new CommonAttachementController)->syncUploadedArray($request->interview_attachs, $injury, 'interview_attachs');
        // }


        if ($channel === 'api') {
            return ApiResponseController::successWithData('Injury updated.', new InjuryCollection($injury));
        }

        return ['success', 'Injury has been updated', $request->redirect];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($injury_id, $channel = 'web')
    {
        RolesPermissionController::can(['injury.delete']);

        $injury = Injury::find($injury_id);
        if (!$injury && $channel === "api") {
            return ApiResponseController::error('Injury not found', 404);
        }

        if (!$injury) {
            return ['error', 'Injury not found'];
        }

        // deleting the Injury
        if ($injury->delete()) {
            if ($channel === 'api') {
                return ApiResponseController::success('Injury has been delete');
            } else {
                return ['deleted', 'Injury has been deleted'];
            }
        } else {
            if ($channel === 'api') {
                return ApiResponseController::error('Could not delete the Injury.');
            } else {
                return ['error', 'Could not delete the Injury'];
            }
        }
    }

    public function assign(Request $request, $injury_id, $channel = 'web')
    {
        $injury = Injury::where('id', $injury_id)->first();
        if ($injury) {
            return (new IncidentAssignController)->store($request, $injury, $channel);
        } else {
            return ApiResponseController::error('Injury not found.', 404);
        }
    }

    public function validateData(Request $request, $method = "store")
    {
        $rules = [
            'meta_injury_category_id' => ['required', 'exists:meta_injury_categories,id'],
            'meta_incident_category_id' => ['required', 'exists:meta_incident_categories,id'],
            'meta_unit_id' => 'required|exists:meta_units,id',
            'meta_location_id' => ['exists:meta_locations,id', new MetaLocationValidate],
            'employee_involved' => ['string', 'in:yes,no,Yes,No'],
            // 'meta_sgfl_relation_id' => ['required', 'exists:meta_sgfl_relations,id'],
            'witness_name' => ['nullable', 'string'],
            'date' => ['date'],
            'details' => ['nullable', 'string'],
            'root_cause' => ['nullable', 'string'],
            'immediate_action' => ['nullable', 'string'],
            'key_finding' => ['nullable', 'string'],
            'actions' => ['array', new InjuryActionData],

            'other_location' => ['nullable', 'string'],
            'meta_department_id' => 'exists:meta_departments,id',
            'line' => ['nullable', 'string'],
            'injured_person' => ['nullable', 'string'],
            'time' => ['nullable', 'date_format:H:i'],


            'meta_immediate_causes' => ['array'],
            'meta_immediate_causes.*' => ['exists:meta_immediate_causes,id'],
            // 'meta_root_causes' => ['array'],
            // 'meta_root_causes.*' => ['exists:meta_root_causes,id'],
            // 'meta_basic_causes' => ['array'],
            // 'meta_basic_causes.*' => ['exists:meta_basic_causes,id'],
            'meta_contact_types' => ['array'],
            'meta_contact_types.*' => ['exists:meta_contact_types,id'],

            'attachements' => ['array', 'nullable'],
            'attachements.*' => ['mimes:jpeg,png,jpg,gif,doc,docx,xlsx,csv,pdf|max:2048'],
            'initial_attachements' => ['array', 'nullable'],
            'initial_attachements.*' => ['mimes:jpeg,png,jpg,gif,doc,docx,xlsx,csv,pdf|max:2048'],
            // 'interview_attachs' => ['array', 'nullable'],
            // 'interview_attachs.*' => ['mimes:jpeg,png,jpg,gif|max:2048'],

        ];

        if ($method == 'update') {
            $rules['meta_unit_id'] = 'nullable|exists:meta_units,id';
            $rules['meta_incident_status_id'] = ['required', 'exists:meta_incident_statuses,id'];
        }
        return Validator::make($request->all(), $rules);
    }

    public static function getNextRef()
    {
        $count = Injury::count();
        $month = date('n');
        $reference = $month . str_pad($count + 1, 2, '0', STR_PAD_LEFT);
        return $reference;
    }
}