<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MetaAuditHall;
use App\Models\MetaAuditType;
use App\Models\MetaBasicCause;
use App\Models\MetaContactType;
use App\Models\MetaDepartment;
use App\Models\MetaDepartmentTag;
use App\Models\MetaDesignation;
use App\Models\MetaFireCategory;
use App\Models\MetaImmediateCause;
use App\Models\MetaIncidentCategory;
use App\Models\MetaInjuryCategory;
use App\Models\MetaInternalExternalAuditQuestion;
use App\Models\MetaLine;
use App\Models\MetaPropertydamage;
use App\Models\MetaPtwItem;
use App\Models\MetaPtwType;
use App\Models\MetaRiskLevel;
use App\Models\MetaRootCause;
use App\Models\MetaSgflRelation;
use App\Models\MetaUnit;
use App\Models\MetaUnsafeBehaviorAction;
use App\Models\MetaUnsafeBehaviorType;
use Illuminate\Http\Request;

class MetaDataApiController extends Controller
{

    public function index(Request $request)
    {
        $metaData = [];

        if (!empty($request->get)) {
            $params = explode(',', $request->get);
            foreach ($params as $param) {
                if (key_exists($param, $this->metaDataKeysBinding())) {
                    $metaData[$param] = $this->metaDataKeysBinding()[$param]::all();
                }
            }
        }
        return ApiResponseController::successWithJustData($metaData);
    }

    protected function metaDataKeysBinding()
    {
        return [
            'designations' => MetaDesignation::class,
            'departments' => MetaDepartment::class,
            'audit_halls' => MetaAuditHall::class,
            'audit_types' => MetaAuditType::class,
            'basic_causes' => MetaBasicCause::class,
            'contact_types' => MetaContactType::class,
            'department_tags' => MetaDepartmentTag::class,
            'fire_categories' => MetaFireCategory::class,
            'immediate_causes' => MetaImmediateCause::class,
            'incident_categorise' => MetaIncidentCategory::class,
            'injury_categories' => MetaInjuryCategory::class,
            'lines' => MetaLine::class,
            'ie_audit_questions' => MetaInternalExternalAuditQuestion::class,
            "property_damages" => MetaPropertydamage::class,
            "ptw_items" => MetaPtwItem::class,
            "ptw_types" => MetaPtwType::class,
            "risk_levels" => MetaRiskLevel::class,
            "root_causes" => MetaRootCause::class,
            'units' => MetaUnit::class,
            'unsafe_behavior_types' => MetaUnsafeBehaviorType::class,
            'unsafe_behavior_actions' => MetaUnsafeBehaviorAction::class,
            'sgfl_relations' => MetaSgflRelation::class,
        ];
    }
}