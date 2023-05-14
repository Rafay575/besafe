<?php
namespace App\Traits;

use App\Models\IncidentAssign;
use App\Models\MetaDepartment;
use App\Models\MetaIncidentStatus;
use App\Models\MetaLine;
use App\Models\MetaUnit;

trait CommonRelation
{
    public function unit()
    {
        return $this->belongsTo(MetaUnit::class, 'meta_unit_id');
    }

    public function department()
    {
        return $this->belongsTo(MetaDepartment::class, 'meta_department_id');
    }

    public function line()
    {
        return $this->belongsTo(MetaLine::class, 'meta_line_id');
    }
    public function incident_status()
    {
        return $this->belongsTo(MetaIncidentStatus::class, 'meta_incident_status_id');
    }

    public function assign_by()
    {
        return $this->hasMany(IncidentAssign::class, 'assign_by');
    }
    public function assign_to()
    {
        return $this->hasMany(IncidentAssign::class, 'assign_to');
    }

    public function assignedUsers()
    {
        return $this->hasMany(IncidentAssign::class, 'incident_id')->where('form_name', $this->getTable());
    }
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

}