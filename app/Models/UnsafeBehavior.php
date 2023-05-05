<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsafeBehavior extends Model
{
    use HasFactory;

    // meta
    public function unsafe_behavior_types()
    {
        return $this->belongsToMany(MetaUnsafeBehaviorType::class, 'unsafe_behavior_and_type');
    }

    public function unit()
    {
        return $this->belongsTo(MetaUnit::class);
    }

    public function department()
    {
        return $this->belongsTo(MetaDepartment::class);
    }

    public function line()
    {
        return $this->belongsTo(MetaLine::class);
    }

    // meta ends above
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function common_attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }
}