<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InternalExternalAuditAnswer extends Model
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



    protected $table = "ie_audit_answers";

    public function audit_clause()
    {
        return $this->belongsTo(InternalExternalAuditClause::class);
    }

    public function audit_question()
    {
        return $this->belongsTo(MetaInternalExternalAuditQuestion::class, 'meta_ie_audit_question_id');
    }


    public function attachements()
    {
        return $this->hasMany(InternalExternalAuditAnswerAttachement::class, 'ie_audit_answer_id');
    }


}