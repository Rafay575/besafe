<?php
namespace App\Traits;

use App\Models\CommonAttachement;
use App\Models\IncidentAssign;
use App\Models\MetaDepartment;
use App\Models\MetaIncidentStatus;
use App\Models\MetaLine;
use App\Models\MetaLocation;
use App\Models\MetaUnit;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait CommonRelation
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $loggerName = ucfirst(str_replace('_', ' ', $this->getTable()));
        $causerName = auth()->user()->first_name;
        $dateAndTime = Carbon::now();
        return LogOptions::defaults()->logAll()->logOnlyDirty()
            ->useLogName($loggerName)
            ->setDescriptionForEvent(fn(string $eventName) => "{$loggerName} has been {$eventName} by {$causerName} on {$dateAndTime}");
    }

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
    public function assignedUsersAll()
    {
        return $this->hasMany(IncidentAssign::class, 'incident_id');
    }
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function meta_location()
    {
        return $this->belongsTo(MetaLocation::class, 'meta_location_id');
    }

    public function common_Attachements()
    {

        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }



}