<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirePropertyDamage extends Model
{
    use HasFactory;
    use CommonRelation;
    protected $casts = [
        'actions' => 'json',
        'loss_calculation' => 'json'
    ];


    public function attachements()
    {

        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }

    public function initial_attachs()
    {
        return $this->attachements()->where('form_input_name', 'initial_attachs');
    }
    public function interview_attachs()
    {
        return $this->attachements()->where('form_input_name', 'interview_attachs');
    }
    public function record_attachs()
    {
        return $this->attachements()->where('form_input_name', 'record_attachs');
    }
    public function photograph_attachs()
    {
        return $this->attachements()->where('form_input_name', 'photograph_attachs');
    }

    public function other_attachs()
    {
        return $this->attachements()->where('form_input_name', 'other_attachs');
    }


    public function fire_category()
    {
        return $this->belongsTo(MetaFireCategory::class, 'meta_fire_category_id');
    }

    public function property_damage()
    {
        return $this->belongsTo(MetaPropertydamage::class, 'meta_property_damage_id');
    }


}