<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hazard extends Model
{
    use HasFactory;
    use CommonRelation;
    // meta
    public function unsafe_behavior_types()
    {
        return $this->belongsToMany(MetaUnsafeBehaviorType::class);
    }

    public function assignedUsers()
    {
        return $this->hasMany(IncidentAssign::class, 'incident_id')->where('form_name', $this->getTable());
    }


    public function risk_level()
    {
        return $this->belongsTo(MetaRiskLevel::class, 'meta_risk_level_id');
    }

    public function department_tag()
    {
        return $this->belongsTo(MetaDepartmentTag::class, 'meta_department_tag_id');
    }

    public function incident_status()
    {
        return $this->belongsTo(MetaIncidentStatus::class, 'meta_incident_status_id');
    }
    // meta ends above
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function common_attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }
}