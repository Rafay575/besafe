<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearMiss extends Model
{
    use HasFactory;

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function common_attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }
}