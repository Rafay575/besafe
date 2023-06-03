<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InternalExternalAuditClause extends Model
{
    use HasFactory;
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
    protected $table = "ie_audit_clauses";
    public function audit_hall()
    {
        return $this->belongsTo(MetaAuditHall::class, 'meta_audit_hall_id');
    }

    public function audit_type()
    {
        return $this->belongsTo(MetaAuditType::class, 'meta_audit_type_id');
    }

    public function audit_answers()
    {
        return $this->hasMany(InternalExternalAuditAnswer::class, 'ie_audit_clause_id');
    }
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }


}