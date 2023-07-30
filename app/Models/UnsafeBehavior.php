<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsafeBehavior extends Model
{
    use HasFactory;
    use CommonRelation;

    public static function getRouteName()
    {
        return 'unsafe-behaviors.show'; // Replace 'unsafe-behaviors' with your actual route name
    }

    public function unsafe_behavior_types()
    {
        return $this->belongsToMany(MetaUnsafeBehaviorType::class, 'unsafe_behavior_and_type');
    }

    public function unsafe_behavior_action()
    {
        return $this->belongsTo(MetaUnsafeBehaviorAction::class, 'meta_unsafe_behavior_action_id');
    }


    // meta ends above

    public function initial_attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'initial_attachements');
    }
    public function attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'attachements');
    }
    public function risk_level()
    {
        return $this->belongsTo(MetaRiskLevel::class, 'meta_risk_level_id');
    }
}