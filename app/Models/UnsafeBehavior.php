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


    // meta ends above

    public function attachements()
    {
        return $this->hasMany(CommonAttachement::class, 'incident_id')->where('form_name', $this->getTable());
    }
}