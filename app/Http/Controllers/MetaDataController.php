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
    MetaSgflRelation
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
        ];

        $auditHalls = MetaAuditHall::all();
        $auditTypes = MetaAuditType::all();
        $basicCauses = MetaBasicCause::all();
        $contactTypes = MetaContactType::all();
        $departments = MetaDepartment::all();
        $departmentTags = MetaDepartmentTag::all();
        $fireCategories = MetaFireCategory::all();
        $designations = MetaDesignation::all();
        $immediateCauses = MetaImmediateCause::all();
        $incidentCategories = MetaIncidentCategory::all();
        $injuryCategories = MetaInjuryCategory::all();
        $lines = MetaLine::all();
        $internalExternalAuditQuestions = MetaInternalExternalAuditQuestion::all();
        $propertyDamages = MetaPropertyDamage::all();
        $ptwItems = MetaPtwItem::all();
        $ptwTypes = MetaPtwType::all();
        $riskLevels = MetaRiskLevel::all();
        $rootCauses = MetaRootCause::all();
        $units = MetaUnit::all();
        $unsafeBehaviorTypes = MetaUnsafeBehaviorType::all();
        $incidentStatuses = MetaIncidentStatus::all();
        $sgflRelations = MetaSgflRelation::all();
        $rootCauses = MetaRootCause::all();
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
                'sgflRelations'
            )
        );
    }

    public function create()
    {

    }
    public function store()
    {

    }

    public function edit()
    {

    }
}