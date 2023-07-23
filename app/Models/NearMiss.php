<?php

namespace App\Models;

use App\Traits\CommonRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearMiss extends Model
{
    use HasFactory;
    use CommonRelation;
    protected $casts = [
        'actions' => 'json',
        'persons' => 'json'
    ];

    public static function getRouteName()
    {
        return 'near-miss.show'; //show route name
    }

    public function near_miss_class()
    {
        return $this->belongsTo(MetaNearMissClass::class, 'meta_near_miss_class_id');
    }

    public function initial_attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'initial_attachements');
    }
    public function attachements()
    {
        return $this->common_Attachements()->where('form_input_name', 'attachements');
    }
}