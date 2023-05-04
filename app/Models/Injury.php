<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    public function common_attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }

    public function injury_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'injury_attachs');
    }

    public function interview_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'interview_attachs');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function injury_category()
    {
        return $this->belongsTo(MetaInjuryCategory::class);
    }

    public function incident_category()
    {
        return $this->belongsTo(MetaIncidentCategory::class);
    }

    // need to edit below pivot base relations here upon confirmation from yousaf

    public function immediate_causes()
    {
        return $this->belongsToMany(MetaImmediateCause::class);
    }

    public function root_causes()
    {
        return $this->belongsToMany(MetaRootCause::class);
    }

    public function basic_causes()
    {
        return $this->belongsToMany(MetaBasicCause::class);
    }

    // this contact means contact with type of material that cause injury, heat, fire,gass, etc
    public function contact()
    {
        return $this->belongsToMany(MetaContactType::class);
    }



}