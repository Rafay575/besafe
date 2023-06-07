<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MetaDataExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'departments' => new MetaDepartmentExcelImport(),
            'designations' => new MetaDesignationExcelImport(),
            'lines' => new MetaLineExcelImport(),
            'units' => new MetaUnitExcelImport(),
            'audit_halls' => new MetaAuditHallExcelImport(),
            'audit_types' => new MetaAuditTypeExcelImport(),
            'ie_audit_questions' => new MetaInternalExternalAuditQuestionExcelImport(),
            'basic_causes' => new MetaBasicCauseExcelImport(),
            'root_causes' => new MetaRootCauseExcelImport(),
            'contact_types' => new MetaContactTypeExcelImport(),
            'department_tags' => new MetaDepartmentTagExcelImport(),
            'fire_categories' => new MetaFireCategoryExcelImport(),
            'immediate_causes' => new MetaImmediateCauseExcelImport(),
            'incident_categories' => new MetaIncidentCategoryExcelImport(),
            'injury_categories' => new MetaInjuryCategoryExcelImport(),
            'property_damages' => new MetaPropertyDamageExcelImport(),
            'ptw_items' => new MetaPtwItemExcelImport(),
            'ptw_types' => new MetaPtwTypeExcelImport(),
            'risk_levels' => new MetaRiskLevelExcelImport(),
            'unsafe_behavior_types' => new MetaUnsafeBehaviorTypeExcelImport(),
            'incident_statuses' => new MetaIncidentStatusExcelImport(),
            'sgfl_relations' => new MetaSgflRelationExcelImport(),
        ];
    }


}