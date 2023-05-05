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
        return $this->belongsTo(MetaAuditType::class);
    }
}