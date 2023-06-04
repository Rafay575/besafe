<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaInternalExternalAuditQuestion extends Model
{
    use HasFactory;
    protected $table = "meta_ie_audit_questions";

    public function audit_type()
    {
        return $this->belongsTo(MetaAuditType::class, 'meta_audit_type_id');
    }

    public function audit_answer()
    {
        return $this->hasMany(InternalExternalAuditAnswer::class, 'meta_ie_audit_question_id');
    }
}