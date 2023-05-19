<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalExternalAuditAnswer extends Model
{
    use HasFactory;

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