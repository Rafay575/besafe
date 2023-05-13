<?php
namespace App\Traits;

use App\Models\IncidentAssign;
use App\Models\MetaDepartment;
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

    public function assign_by()
    {
        return $this->hasMany(IncidentAssign::class, 'assign_by');
    }
    public function assign_to()
    {
        return $this->hasMany(IncidentAssign::class, 'assign_to');
    }
}