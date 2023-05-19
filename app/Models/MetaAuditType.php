<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaAuditType extends Model
{
    use HasFactory;

    public function audit_clauses()
    {
        return $this->hasMany(InternalExternalAuditClause::class);
    }

    public function audit_questions()
    {
        return $this->hasMany(MetaInternalExternalAuditQuestion::class, 'meta_audit_type_id');
    }
}