<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalExternalAuditClause extends Model
{
    use HasFactory;
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



}