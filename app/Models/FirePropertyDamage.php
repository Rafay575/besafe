<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirePropertyDamage extends Model
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

    public function initial_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'initial_attachs');
    }
    public function interview_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'interview_attachs');
    }
    public function record_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'record_attachs');
    }
    public function photograph_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'photograph_attachs');
    }

    public function other_attachs()
    {
        return $this->common_attachements()->where('form_input_name', 'other_attachs');
    }

    public function unit()
    {
        return $this->belongsTo(MetaUnit::class);
    }

    public function fire_category()
    {
        return $this->belongsTo(MetaFireCategory::class);
    }

    public function property_demage()
    {
        return $this->belongsTo(MetaPropertyDemage::class);
    }


}