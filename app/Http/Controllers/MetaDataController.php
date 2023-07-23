<?php

namespace App\Http\Controllers;

use App\Models\{
    MetaAuditHall,
    MetaAuditType,
    MetaBasicCause,
    MetaContactType,
    MetaDepartment,
    MetaDepartmentTag,
    MetaFireCategory,
    MetaDesignation,
    MetaImmediateCause,
    MetaIncidentCategory,
    MetaInjuryCategory,
    MetaLine,
    MetaInternalExternalAuditQuestion,
    MetaPropertyDamage,
    MetaPtwItem,
    MetaPtwType,
    MetaRiskLevel,
    MetaRootCause,
    MetaUnit,
    MetaUnsafeBehaviorType,
    MetaIncidentStatus,
    MetaSgflRelation,
    MetaUnsafeBehaviorAction,
    MetaLocation,
    MetaNearMissClass
};
use Illuminate\Http\Request;

class MetaDataController extends Controller
{
    public function index()
    {
        $menus = [
            'Departments',
            'Designations',
            'Lines',
            'Units',
            'Audit Halls',
            'Audit Types',
            'IE Audit Questions',
            'Basic Cause',
            'Root Cause',
            'Contact Types',
            'Department Tags',
            'Fire Categories',
            'Immediate Causes',
            'Incident Categories',
            'Injury Categories',
            'Property Damages',
            'PTW Items',
            'PTW Types',
            'Risk Levels',
            'Unsafe Behavior Types',
            'Incident Statuses',
            'SGFL Relations',
            'Unsafe Behavior Actions',
            'Locations',
            'Near Miss Classification'
        ];

        $auditHalls = MetaAuditHall::latest()->get();
        $auditTypes = MetaAuditType::latest()->get();
        $basicCauses = MetaBasicCause::latest()->get();
        $contactTypes = MetaContactType::latest()->get();
        $departments = MetaDepartment::latest()->get();
        $departmentTags = MetaDepartmentTag::latest()->get();
        $fireCategories = MetaFireCategory::latest()->get();
        $designations = MetaDesignation::latest()->get();
        $immediateCauses = MetaImmediateCause::latest()->get();
        $incidentCategories = MetaIncidentCategory::latest()->get();
        $injuryCategories = MetaInjuryCategory::latest()->get();
        $lines = MetaLine::latest()->get();
        $internalExternalAuditQuestions = MetaInternalExternalAuditQuestion::latest()->get();
        $propertyDamages = MetaPropertyDamage::latest()->get();
        $ptwItems = MetaPtwItem::latest()->get();
        $ptwTypes = MetaPtwType::latest()->get();
        $riskLevels = MetaRiskLevel::latest()->get();
        $rootCauses = MetaRootCause::latest()->get();
        $units = MetaUnit::latest()->get();
        $unsafeBehaviorTypes = MetaUnsafeBehaviorType::latest()->get();
        $incidentStatuses = MetaIncidentStatus::latest()->get();
        $sgflRelations = MetaSgflRelation::latest()->get();
        $rootCauses = MetaRootCause::latest()->get();
        $near_miss_classification = MetaNearMissClass::latest()->get();
        $unsafe_behavior_actions = MetaUnsafeBehaviorAction::latest()->get();
        $locations = MetaLocation::with('unit')->latest()->get();
        return view(
            'meta-data.index',
            compact(
                'menus',
                'rootCauses',
                'departments',
                'auditHalls',
                'auditTypes',
                'basicCauses',
                'contactTypes',
                'departments',
                'departmentTags',
                'fireCategories',
                'designations',
                'immediateCauses',
                'incidentCategories',
                'injuryCategories',
                'lines',
                'internalExternalAuditQuestions',
                'propertyDamages',
                'ptwItems',
                'ptwTypes',
                'riskLevels',
                'rootCauses',
                'units',
                'unsafeBehaviorTypes',
                'incidentStatuses',
                'sgflRelations',
                'unsafe_behavior_actions',
                'locations',
                'near_miss_classification'
            )
        );
    }

    public function create($meta_data_name)
    {
        return view('meta-data.create', compact('meta_data_name'));
    }
    public function store(Request $request)
    {
        $requestData = $request->except('_token', 'redirect', 'meta_data_id', 'meta_data_name');
        $requestKeys = array_keys($requestData);
        $redirect = str_replace('_', '-', $request->meta_data_name);
        $metaDataTitle = ucfirst(str_replace("_", " ", $request->meta_data_name));
        $modelClass = $this::getMetaDataModelClass($request->meta_data_name);
        if ($modelClass) {
            if ($request->has('meta_data_id') && $request->meta_data_id != "") {
                // updating meta data
                $data = $modelClass::find($request->meta_data_id);
                foreach ($requestKeys as $key) {
                    $data->$key = $request->$key;
                    $data->save();
                    $message = "Updated";
                }
            } else {
                // creating meta data
                $data = $modelClass::create($requestData);
                $message = "Created";
            }
            return ['success', "{$metaDataTitle} has been {$message}!", route('meta-data.index') . "?saved={$data->id}#{$redirect}"];
        } else {
            return ['error', 'Key not found for the class'];
        }

    }

    public function edit()
    {

    }

    public static function getMetaDataModelClass($key)
    {

        $models = [
            'departments' => MetaDepartment::class,
            'designations' => MetaDesignation::class,
            'lines' => MetaLine::class,
            'units' => MetaUnit::class,
            'audit_halls' => MetaAuditHall::class,
            'audit_types' => MetaAuditType::class,
            'ie_audit_questions' => MetaInternalExternalAuditQuestion::class,
            'basic_causes' => MetaBasicCause::class,
            'root_causes' => MetaRootCause::class,
            'contact_types' => MetaContactType::class,
            'department_tags' => MetaDepartmentTag::class,
            'fire_categories' => MetaFireCategory::class,
            'immediate_causes' => MetaImmediateCause::class,
            'incident_categories' => MetaIncidentCategory::class,
            'injury_categories' => MetaInjuryCategory::class,
            'property_damages' => MetaPropertyDamage::class,
            'ptw_items' => MetaPtwItem::class,
            'ptw_types' => MetaPtwType::class,
            'risk_levels' => MetaRiskLevel::class,
            'unsafe_behavior_types' => MetaUnsafeBehaviorType::class,
            'incident_statuses' => MetaIncidentStatus::class,
            'sgfl_relations' => MetaSgflRelation::class,
            'unsafe_behavior_actions' => MetaUnsafeBehaviorAction::class,
            'locations' => MetaLocation::class,
            'near_miss_classification' => MetaNearMissClass::class,
        ];

        if (array_key_exists($key, $models)) {
            return $models[$key];
        }
        return false;
    }

    public function destroy(Request $request, $meta_data_id, $meta_data_name)
    {
        $modelClass = $this::getMetaDataModelClass($meta_data_name);
        $redirect = str_replace('_', '-', $request->meta_data_name);
        $metaDataTitle = ucfirst(str_replace("_", " ", $request->meta_data_name));
        $data = $modelClass::where('id', $meta_data_id)->first();
        if (!$data) {
            return ["{$metaDataTitle} not found"];
        }
        if ($data->delete()) {
            return ['deleted', "{$metaDataTitle} has been deleted!"];
        }
    }
}