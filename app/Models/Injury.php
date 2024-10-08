<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;
    use CommonRelation;

    protected $casts = [
        'actions' => 'json',
    ];
    public static function getRouteName()
    {
        return 'injuries.show'; //show route name
    }




    public function initial_attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'initial_attachements');
    }
    public function attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'attachements');
    }
    public function interview_attachs()
    {
        return $this->common_Attachements()->where('form_input_name', 'interview_attachs');
    }



    public function injury_category()
    {
        return $this->belongsTo(MetaInjuryCategory::class, 'meta_injury_category_id');
    }

    public function msgfl_relation()
    {
        return $this->belongsTo(MetaSgflRelation::class, 'meta_sgfl_relation_id');
    }

    public function incident_category()
    {
        return $this->belongsTo(MetaIncidentCategory::class, 'meta_incident_category_id');
    }

    // need to edit below pivot base relations here upon confirmation from yousaf

    public function immediate_causes()
    {
        return $this->belongsToMany(MetaImmediateCause::class, 'meta_immediate_cuase_injury');
    }

    // public function root_causes()
    // {
    //     return $this->belongsToMany(MetaRootCause::class, 'meta_root_cause_injury');
    // }

    public function basic_causes()
    {
        return $this->belongsToMany(MetaBasicCause::class, 'meta_basic_cause_injury');
    }

    // this contact means contact with type of material that cause injury, heat, fire,gass, etc
    public function contacts()
    {
        return $this->belongsToMany(MetaContactType::class, 'meta_contact_type_injury');
    }

    public static function getHighestRefForYear($year)
    {
        return self::whereYear('date', $year)
                    ->selectRaw('MAX(SUBSTRING_INDEX(reference, "-", -1)) AS highest_ref')
                    ->first()->highest_ref;
    }

}